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

        // public function getByLimit(int $limit_count =10)
        // {
        //     return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
        // }

        // public function getPaginateByLimit(int $limit_count = 10)
        // {
        //     // 降順✖️limitで件数制限
        //     return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
        // }
    }
    

