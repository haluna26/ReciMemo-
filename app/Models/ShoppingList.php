<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;
    protected $table = 'shopping_lists';

    protected $fillable = [
        'item',
        'user_id'
    ];
}
