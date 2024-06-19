<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryFinalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cats = ['Sea', 'Mountain', 'City', 'Landscape', 'Animals', 'Neon', 'Cyberpunk', 'Sky', 'Island', 'Tech', 'Night Lights'];


        foreach($cats as $cat){
            $category = new Category();
            $category->title = $cat;
            $category->slug = Str::slug($cat, '-');
            $category->save();
        }
    }
}
