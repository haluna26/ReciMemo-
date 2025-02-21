<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Recipeへのリレーション　一対多より、recipesと複数形にする
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
