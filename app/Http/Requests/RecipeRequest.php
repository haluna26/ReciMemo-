<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'recipe.name' => 'required|string|max:100',
            'recipe.food' => 'required|string|max:500',
            'recipe.method' => 'required|string|max:4000',
        ];
    }
}
