<?php

    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Recipe extends Model
    {
        use HasFactory;
    
        protected $fillable = [
            'title',
            'value',
            'level',
            'ingredients', 
            'url',
            'image',
            'description',
            'instructions',
            'user_id'
        ];

        protected $guarded = [];
    }
    

