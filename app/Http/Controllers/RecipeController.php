<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RecipeRequest; 
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        // $query = Recipe::query(); // レシピモデルのクエリビルダーを作成
        $query = Recipe::where('user_id', Auth::id()); // 👈 ログインユーザーのレシピのみ取得

        //　検索フォームからのキーワード取得
        $search = $request->input('search');

        if (!empty($search)) {
            // 検索ワードがある場合、タイトルまたは材料名に一致するものを取得
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%") // LIKE=部分一致検索
                  ->orwhere('ingredients', 'LIKE', "%{$search}%"); //タイトルや材料名に検索ワードが含まれるものを取得
            });
        }
        // 新しい順（created_atの降順）で取得
        $recipes = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('recipes.index', compact('recipes', 'search'));
    }

    // categoryの選択が可能になる create()は一つのみ
    public function create(Category $category)
    {

        // ユーザーごとの入力履歴を取得
        $previousInput = session()->get('recipe_input_' . Auth::id(), []);

        return view('recipes.create')->with([
            'categories' => $category->get(),
            'previousInput' => $previousInput
        ]);
    }

    

    public function store(Request $request)
    {

    $validated = $request->validate([
        'recipe.title'       => 'required|string|max:255',
        'recipe.ingredients' => 'required|string',
        'recipe.value'       => 'nullable|integer|min:1|max:5',
        'recipe.level'       => 'nullable|integer|min:1|max:5',
        'recipe.description' => 'nullable|string|max:1000',
        'recipe.instructions'=> 'nullable|string|max:1000',
        'recipe.url'         => 'nullable|url',  // バリデーション済み
        'recipe.images.*'    => 'nullable|image|max:2048',
        'new_category'       => 'nullable|string|max:255',
        'recipe.category_id' => 'required|integer|exists:categories,id'
    ]);
    
    // セッションに保存（ログインユーザーごとに管理）
    session()->put('recipe_input_' . Auth::id(), $validated['recipe']);

    // 画像の保存
    $imageUrls = [];
    if ($request->hasFile('recipe.images')) {
        foreach ($request->file('recipe.images') as $image) {
            $uploadedFileUrl = Cloudinary::upload($image->getRealPath())->getSecurePath();
            $imageUrls[] = $uploadedFileUrl;
            // $path = $image->store('images', 'public'); 
            // $imagePaths[] = $path;
        }
    }


    // レシピデータをデータベースに保存
    $recipe = new Recipe();
    $recipe->title        = $validated['recipe']['title'];
    $recipe->ingredients  = $validated['recipe']['ingredients'];
    $recipe->value        = $validated['recipe']['value'] ?? null;
    $recipe->level        = $validated['recipe']['level'] ?? null;
    $recipe->description  = $validated['recipe']['description'] ?? '';
    $recipe->instructions = $validated['recipe']['instructions'] ?? '';
    $recipe->url          = $validated['recipe']['url'] ?? null;  // ★ URL を代入
    $recipe->user_id      = Auth::id(); 
    $recipe->category_id  = $validated['recipe']['category_id'];
    // $recipe->image        = $imagePaths;
    $recipe->image        =json_encode($imageUrls); // Cloudinaryの画像URLを保存
    $recipe->save();

    // session()->forget('recipe');

    return redirect()->route('recipes.index')->with('success', 'レシピが作成されました。');
    }

    

    public function show(Recipe $recipe)
    {
        // 👇 他のユーザーのレシピを見れないようにする
        if ($recipe->user_id !== Auth::id()) {
            abort(403, 'このレシピにアクセスする権限がありません。');
        }

        $category = $recipe->category; // リレーションを利用してカテゴリーを取得

        return view('recipes.show', compact('recipe', 'category'));

    }

    public function edit($id)
    {
        // $recipe = Recipe::findOrFail($id);
        $recipe = Recipe::where('id', $id)->where('user_id', Auth::id())->firstOrFail(); // 👈 自分のレシピのみ取得

        $categories = Category::all(); // 既存のカテゴリを取得

        // ユーザーごとの入力履歴を取得（編集ページ用）
        $previousInput = session()->get('recipe_input_' . Auth::id(), []);


        return view('recipes.edit', compact('recipe', 'categories', 'previousInput'));
        // return redirect('/recipes/{recipe}');
    }

    public function update(Request $request, $id)
    {
    // バリデーションルールに instructions を追加
    $validated = $request->validate([
        'recipe.title'        => 'required|string|max:255',
        'recipe.ingredients'  => 'required|string',
        'recipe.description'  => 'nullable|string|max:1000',
        'recipe.instructions' => 'nullable|string|max:1000', // ★ 追加
        'recipe.value'        => 'nullable|integer|min:1|max:5',
        'recipe.level'        => 'nullable|integer|min:1|max:5',
        'recipe.category_id'  => 'required|integer|exists:categories,id',
        'recipe.url'       => 'nullable|url', // 必要なら
        'new_category'        => 'nullable|string|max:255',
        'recipe.images.*'     => 'nullable|image|max:2048'
    ]);

    // レシピの取得
    $recipe = Recipe::where('id', $id)->where('user_id', Auth::id())->firstOrFail(); // 👈 自分のレシピのみ取得
    // $recipe = Recipe::findOrFail($id);

    // 新規カテゴリーの処理（必要なら）
    if (!empty($validated['new_category'])) {
        $newCategory = Category::create(['name' => $validated['new_category']]);
        $validated['recipe']['category_id'] = $newCategory->id;
    }

    // バリデーション済みデータをモデルに反映（instructions も含む）
    $recipe->fill($validated['recipe']);

    // ユーザーIDの更新（必要なら）
    $recipe->user_id = Auth::id();

    // 既存の画像を取得
    $existingImages = json_decode($recipe->image, true) ?? [];

    // 画像の保存処理
    if ($request->hasFile('recipe.images')) {
        foreach ($request->file('recipe.images') as $image) {
            $uploadedFileUrl = Cloudinary::upload($image->getRealPath())->getSecurePath();
            $existingImages[] = $uploadedFileUrl; // 既存の画像リストに追加
            // $path = $image->store('images', 'public');
            // $imagePaths[] = $path;
        }
    }
    // 画像がアップロードされていれば更新
    // if (!empty($imagePaths)) {
    //     $recipe->image = $imagePaths; // キャストを使っている場合は配列のまま代入OK
    // }

    // 画像をJSON形式で保存
    $recipe->image = json_encode($existingImages);

    // DBに保存
    $recipe->save();

    return redirect()->route('recipes.index')->with('success', 'レシピが更新されました');
    }

    public function delete(Recipe $recipe)
    {
        $recipe->delete();
        return redirect('/recipes');
    }

}
