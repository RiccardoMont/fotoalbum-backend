<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 0; $i < 20; $i++){
            $photo = new Photo();
            $photo->title = $faker->word(5, true);
            $photo->image = $faker->imageUrl(600, 400, 'Photos', true, $photo->title, true, 'jpg');
            $photo->description = $faker->paragraphs(3, true);
            $photo->slug = Str::of($photo->title)->slug('-');
            $photo->save();
        }
    }
}
