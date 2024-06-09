<?php

namespace Database\Seeders;

use App\Models\BestShoot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class BestShootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bests = ['Bests', 'Weekly shoot', 'Monthly shoot'];

        foreach($bests as $best){
            $bestshoot = new BestShoot();
            $bestshoot->title = $best;
            $bestshoot->slug = Str::slug($best, '-');
            $bestshoot->save();

        }
        
    }
}
