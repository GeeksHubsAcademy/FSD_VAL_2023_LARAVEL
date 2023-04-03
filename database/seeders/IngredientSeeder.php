<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->insert(
            [
                'name' => "mushroom",
            ],
        );

        DB::table('ingredients')->insert(
            [
                'name' => "tomato",
            ],
        );

        DB::table('ingredients')->insert(
            [
                'name' => "oregano",
            ],
        );

        DB::table('ingredients')->insert(
            [
                'name' => "pineapple",
            ],
        );
    }
}
