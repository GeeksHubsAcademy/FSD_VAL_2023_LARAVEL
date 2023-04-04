<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class PizzaController extends Controller
{
    public function getAllPizzas()
    {
        $pizzas = Pizza::query()->get();

       

        return [
            "success" => true,
            "data" =>$pizzas
        ];

    }
}
