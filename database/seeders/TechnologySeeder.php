<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $Faker)
    {
        $technologyList = ['HTML5', 'CSS3', 'JS', 'Vue 3', 'Vite', 'Bootstrap', 'NodeJS',  'PHP', 'Laravel'];
        foreach ($technologyList as $technologyName) {
            $newTecnology = new Technology();
            $newTecnology->name = $technologyName;
            $newTecnology->bg_color = $Faker->unique()->hexColor();
            $newTecnology->save();
        }
    }
}
