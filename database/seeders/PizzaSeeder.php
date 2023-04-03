<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pizzas')->insert(
            [
                [
                    'name' => "Carbonara",
                    'type' => "original",
                ],
                [
                    'name' => "Hawaiana",
                    'type' => "pan_pizza",
                ],
                [
                    'name' => "Barbacoa",
                    'type' => "fina",
                ]
            ]
        );

        DB::table('pizzas')->insert(
            [
                'name' => "Margarita",
                'type' => "original",
                'is_active' => false
            ],
        );
    }
}
