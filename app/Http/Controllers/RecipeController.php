<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RecipeRequest; 
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query(); // レシピモデルのクエリビルダーを作成

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

        // $recipe = Recipe::all();
        // $recipes = Recipe::paginate(5); // 1ページに表示するアイテム数
        return view('recipes.index', compact('recipes', 'search'));
        // return view('recipes.index', ['recipes' => $recipe]); 
        // return $recipe->get();
    }

    // categoryの選択が可能になる create()は一つのみ
    public function create(Category $category)
    {
        return view('recipes.create')->with(['categories' => $category->get()]);
    }

    // public function create(Request $request)
    // {
    //     return view('recipes.create');
    //     // return redirect('/recipes');
    // }

    // セッションにデータを一時保存
    public function store(Request $request)
    {
    
    $validated = $request->validate([
        'recipe.title' => 'required|string|max:255',
        'recipe.ingredients' => 'required|string',
        'recipe.value' => 'nullable|integer|min:1|max:5',
        'recipe.level' => 'nullable|integer|min:1|max:5',
        'recipe.description' => 'nullable|string|max:1000',
        'recipe.images.*' => 'nullable|image|max:2048', // ”一枚あたり”2MBまで
        'new_category' => 'nullable|string|max:255',
    ]);

    // 画像のデータをセッションに格納（画像は一時的に保存しない）
    if ($request->hasFile('recipe.images')) {
        $imagePaths = [];
        foreach ($request->file('recipe.images') as $image) {
            $path = $image->store('images', 'public'); // storage/app/public/imagesに保存
            $imagePaths[] = $path;
        }
        session(['recipe.images' => $imagePaths]);
    }
    // $data = $request->all();
    // $data['recipe']['title'] = $validated['recipe']['title'];
    // $data['recipe']['ingredients'] = $validated['recipe']['ingredients'];
    // $data['recipe']['user_id'] = Auth::id(); // ユーザーIDを追加

    // $categoryId = $request->input('recipe.category_id');// 既存のカテゴリーIDを取得

    
    // データベースに保存
    // $recipe = new Recipe();
    // $recipe->fill($data['recipe']);
    // $recipe->category_id = $categoryId;

    //　画像の保存処理
    // $imagePaths = []; // 画像のパスを保存する配列
    // if ($request->hasFile('recipe.images')) {
    //     foreach ($request->file('recipe.images') as $image) {
    //         $path = $image->store('images', 'public'); // storage/app/public/imagesに保存
    //         $imagePaths[] = $path;
    //     }
    // }
        
    //     $recipe->image = !empty($imagePaths) ? json_encode($imagePaths) : json_encode([]);
    //     $recipe->save();
    
    // return redirect()->route('recipes.index')->with('success', 'レシピが作成されました！');

    // フォームデータをセッションに保存
    session([
        'recipe.title' => $validated['recipe']['title'],
        'recipe.ingredients' => $validated['recipe']['ingredients'],
        'recipe.value' => $validated['recipe']['value'],
        'recipe.level' => $validated['recipe']['level'],
        'recipe.description' => $validated['recipe']['description'],
        'new_category' => $validated['new_category'],
    ]);
    dd(session()->all()); 

    // 入力されたデータをセッションに保存
    session()->put('recipe', $request->input('recipe'));

    // フォームの内容をセッションに一時保存
    session()->put('recipe.description', $request->input('recipe.description'));


    // セッションに保存したデータをフォームに戻して表示（必要なら）
    return redirect()->route('recipes.create');
    }

    // 保存ボタンが押された時に、セッションからデータをデータベースに保存
    public function storeFinal(Request $request)
    {
        // セッションからデータを取得
        $data = session()->get('recipe');

        if (!$data) {
            return redirect()->route('recipes.create')->with('error', 'レシピデータが一時保存されていません。');
        }

        $validated = $request->validate([
            'recipe.title' => 'required|string|max:255',
            'recipe.ingredients' => 'required|string',
            'recipe.value' => 'nullable|integer|min:1|max:5',
            'recipe.level' => 'nullable|integer|min:1|max:5',
            'recipe.description' => 'nullable|string|max:1000',
            'recipe.images.*' => 'nullable|image|max:2048', // ”一枚あたり”2MBまで
        ]);

        // データベースに保存
        $recipe = new Recipe();
        $recipe->title = $data['title'];
        $recipe->ingredients = $data['ingredients'];
        $recipe->value = $data['value'];
        $recipe->level = $data['level'];
        $recipe->description = session('recipe.description', ''); // 説明はセッションから取得
        $recipe->user_id = Auth::id(); // ユーザIDを取得
        $recipe->category_id = $request->input('recipe.category_id');

        // 画像を保存
        if ($request->hasFile('recipe.images')) {
            $imagePaths = [];
            foreach ($request->file('recipe.images') as $image) {
                $path = $image->store('images', 'public'); // storage/app/public/imagesに保存
                $imagePaths[] = $path;
            }
            $recipe->image = json_encode($imagePaths);
    } else {
        // セッションに保存されている画像があれば使用
        $recipe->image = json_encode(session('recipe.images', []));
    }

    $recipe->save();

    // セッションのレシピデータを削除
    session()->forget('recipe');

    return redirect()->route('recipes.index')->with('success', 'レシピが作成されました！');
    }

    public function show(Recipe $recipe)
    {
        $category = $recipe->category; // リレーションを利用してカテゴリーを取得
        return view('recipes.show', compact('recipe', 'category'));

    }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        $categories = Category::all(); // 既存のカテゴリを取得

        return view('recipes.edit', compact('recipe', 'categories'));
        // return redirect('/recipes/{recipe}');
    }

    public function update(Request $request, $id)
    {
        //バーリデーション
        $validated = $request->validate([
            'recipe.title' => 'required|string|max:255',
            'recipe.ingredients' => 'required|string',
            'recipe.description' => 'nullable|string|max:1000',
            'new_category' => 'nullable|string|max:255'
        ]);
        $data = $request->all();
        $data['recipe']['title'] = $validated['recipe']['title'];
        $data['recipe']['ingredients'] = $validated['recipe']['ingredients'];
        $data['recipe']['user_id'] = Auth::id(); // ユーザーIDを追加

        $categoryId = $request->input('recipe.category_id');
        
        $recipe = Recipe::findOrFail($id);

        $recipe->fill($data['recipe']);
        // $recipe->fill([
        //     'recipe.title' => 'required|string|max:255',
        //     'recipe.ingredients' => 'required|string',
        //     'recipe.user_id' => Auth::id(), // ユーザーIDを更新
        // ]);
        $recipe->category_id = $categoryId;

        //　画像の保存処理
        $imagePaths = []; // 画像のパスを保存する配列
        if ($request->hasFile('recipe.images')) {
            foreach ($request->file('recipe.images') as $image) {
                $path = $image->store('images', 'public'); // storage/app/public/imagesに保存
                $imagePaths[] = $path;
            }
        }
        $recipe->image = !empty($imagePaths) ? json_encode($imagePaths) : json_encode([]);

        $recipe->save(); //レシピを更新
        //update() メソッドを使うことで一度にバリデーション済みのデータを保存することができます
        // $recipe->fill($input_recipe)->save();

        // return redirect('/recipes/' . $recipe->id);
        return redirect()->route('recipes.index')->with('success', 'レシピが更新されました');
    }

    public function delete(Recipe $recipe)
    {
        $recipe->delete();
        return redirect('/recipes');
    }

}
