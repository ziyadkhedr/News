<?php

namespace Database\Seeders;

use App\Models\Relatedsite;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelatedSitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $faker = Factory::create();
        for ($i = 0; $i < 5; $i++) {
            Relatedsite::create([
            'name'=>$faker->sentence(1),
            'url'=> $faker->url]);
        }
    }
}
