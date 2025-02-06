<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RecipeRequest; 

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Recipe $recipe)
    {
        $recipe = Recipe::all();
        return view('recipes.index', ['recipes' => $recipe]); 
        // return $recipe->get();
    }

    public function create(Request $request)
    {
        return view('recipes.create');
        // return redirect('/recipes');
    }

    // public function store(Request $request)
    // {
    //     //inputはリクエストから取得したすべての入力データを格納する変数として使用される。⇨バーリデーションを通す前のデータが含まれていることが特徴
    //     //inputはバーリデーション不要のデータを扱う場合、フォームの入力状況によってバーリデーションのルールに変化を与える場合、プログラム側で生成したデータを追加したい場合に好まれる
    //     $input = $request['recipe'];
    //     //バーリデーション＝入力データが正しい形式であるかをチェックする処理
    //     //フォームから送られたデータを問題がなければ$validated に保存する （validated推奨。空欄や誤データが入らないので）
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255', //required=必須項目、string=文字列、
    //         'value' => 'nullable|integer|min:1|max:5', //integer＝整数、max＝stringなら文字列の最大長、integerなら最大値
    //         'level' => 'nullable|integer|min:1|max:5',
    //         'ingredient' => 'required|string',
    //         'url' => 'nullable|string',
    //         'image' => 'nullable|string',
    //         'description' => 'nullable|string',
    //         'instructions' => 'nullable|string', //nullable=空欄ok
    //     ]);
    //     //＄inputのまま保存
    //     // $data = $validatedData['recipe']; // recipe配下のデータだけ取り出す
    //     // $data['user_id'] = Auth::id();
    //     $validated['user_id'] = Auth::id(); //ユーザIDの追加　Auth::id();＝ログインIDを取得するためのlaravel関数
    //     $recipe = new Recipe(); // 新しいインスタンスを作成
    //     dd($request->all()); // ここでリクエストデータを確認
    //     $recipe = new Recipe();
    //     $recipe->title = $request->title;
    //     $recipe->ingredients = $request->ingredients;
    //     $recipe->instructions = $request->instructions;
    //     $recipe->save();
    //     $recipe->fill($validated)->save(); //レシピを保存
    //     return redirect()->route('recipes.index')->with('success', 'レシピが作成されました！');
    //     // return redirect('recipes.index' . $recipe->id);
    //     // web.phpのstoreに対応するルーティングに変更する必要がある。
    // }
    public function store(Request $request)
    {
    // $validated = $request->validate([
    //     'title' => 'required|string|max:255',
    //     'value' => 'nullable|integer|min:1|max:5',
    //     'level' => 'nullable|integer|min:1|max:5',
    //     'ingredients' => 'required|string',
    //     'url' => 'nullable|string',
    //     'image' => 'nullable|string',
    //     'description' => 'nullable|string',
    //     'instructions' => 'nullable|string',
    // ]);

    // $validated['user_id'] = Auth::id(); // Add the user_id to validated data

    // $recipe = new Recipe();
    // $recipe->fill($validated); // Fill the model with validated data
    // $recipe->save(); // Save the model

    // return redirect()->route('recipes.index')->with('success', 'レシピが作成されました！');
    $validated = $request->validate([
        'recipe.title' => 'required|string|max:255',
        'recipe.ingredients' => 'required|string',
    ]);

    $data = $request->all();
    $data['recipe']['title'] = $validated['recipe']['title'];
    $data['recipe']['ingredients'] = $validated['recipe']['ingredients'];
    $data['recipe']['user_id'] = Auth::id(); // ユーザーIDを追加

    $recipe = new Recipe();
    $recipe->fill($data['recipe']);
    $recipe->save();

    return redirect()->route('recipes.index')->with('success', 'レシピが作成されました！');
    }


    public function show(Recipe $recipe)
    {
        return view('recipes.show')->with(['recipe' => $recipe]);

    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit')->with(['recipe' => $recipe]);
        // return redirect('/recipes/{recipe}');
    }

    public function update(Request $request, $id)
    {
        //バーリデーション
        $validated = $request->validate([
            'recipe.title' => 'required|string|max:255',
            'recipe.ingredients' => 'required|string',
        ]);
        $data = $request->all();
        $data['recipe']['title'] = $validated['recipe']['title'];
        $data['recipe']['ingredients'] = $validated['recipe']['ingredients'];
        $data['recipe']['user_id'] = Auth::id(); // ユーザーIDを追加
        
        $recipe = Recipe::findOrFail($id);

        $recipe->fill($data['recipe']);
        // $recipe->fill([
        //     'recipe.title' => 'required|string|max:255',
        //     'recipe.ingredients' => 'required|string',
        //     'recipe.user_id' => Auth::id(), // ユーザーIDを更新
        // ]);
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
