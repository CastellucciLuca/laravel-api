<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $Faker)
    {
        $users = User::all();

        $rolesId = Role::all()->pluck('id');
        
        foreach ($users as $user) {
            $user->roles()->attach($Faker->randomElements($rolesId, 2));
        }
    }
}