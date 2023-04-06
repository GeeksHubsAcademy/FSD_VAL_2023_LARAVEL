<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PizzaSeeder::class,
        ]);
        
        \App\Models\User::factory(10)->create();
        \App\Models\Review::factory(150)->create();
    }
}
