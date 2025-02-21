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
            'user_id',
            'category_id'
        ];

        protected $guarded = [];

        protected $casts = [
            'image' => 'array', // JSONとして使用
        ];

        // Categoryに対するリレーション　一対多　categoryは単数系に。
        public function category()
        {
            return $this->belongsTo(Category::class);
        }
    }
    

