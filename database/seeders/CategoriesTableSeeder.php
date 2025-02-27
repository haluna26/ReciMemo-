<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'お肉'],
            ['name' => '魚介'],
            ['name' => '卵料理'],
            ['name' => 'ごはんもの・餅'],
            ['name' => '麺類'],
            ['name' => 'パスタ・グラタン'],
            ['name' => '粉もの'],
            ['name' => '野菜'],
            ['name' => 'スープ・汁物'],
            ['name' => 'お菓子・スイーツ'],
            ['name' => 'パン'],
            ['name' => 'その他']
        ];

        foreach ($categories as $category){
            DB::table('categories')->updateOrInsert(['name' => $category['name']], $category);
        }
    }
}
