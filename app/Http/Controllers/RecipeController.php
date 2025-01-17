<?php

namespace App\Http\Controllers;
use App\Models\Recipe;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Recipe $recipe)
    {
        $recipe = Recipe::all();
        return view('recipes.index', ['recipes' => $recipe]); 
        // return $recipe->get();
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', ['recipe' => $recipe]); 
    }
}
