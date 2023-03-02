<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesList = ['front-end','back-end','full-stack'];
        foreach ($typesList as $type) {
            $newType = new Type();
            $newType->name = $type;
            $newType->save();
        }
    }
}
