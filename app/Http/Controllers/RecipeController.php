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

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Recipe $recipe, RecipeRequest $request)
    {
        $input = $request['recipe'];
        $input['user_id']=Auth::id();
        $recipe->fill($input)->save();
        return redirect('/recipes');
        // return redirect('recipes.index' . $recipe->id);
        // web.phpのstoreに対応するルーティングに変更する必要がある。
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show')->with(['recipe' => $recipe]);
        return redirect('/recipes/' . $recipe->id);
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit')->with(['recipe' => $recipe]);
        return redirect('/recipes/{recipe}');
    }

    public function update(RecipeRequest $request, Recipe $recipe)
    {
        $input_recipe = $request['recipe'];
        $input['user_id']=Auth::id();
        $recipe->fill($input_recipe)->save();

        return redirect('/recipes/' . $recipe->id);
    }
}
