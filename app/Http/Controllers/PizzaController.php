<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PizzaController extends Controller
{
    public function getAllPizzas()
    {
        // ToDo manejo de errores
        $pizzas = Pizza::query()->get();



        return [
            "success" => true,
            "data" => $pizzas
        ];
    }

    public function createPizza(Request $request)
    {
        try {
            // DB::table('pizzas')->insert([
            //     "name" => $request->input('name'),
            //     "type" => $request->input('type')
            // ]);

            Log::info("Create Pizza");

            $validator = Validator::make($request->all(), [
                'name' => 'required | regex:/^[A-Za-z0-9]+$/',
                'type' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $name = $request->input('name');
            $type = $request->input('type');

            $pizza = new Pizza();
            $pizza->name = $name;
            $pizza->type = $type;
            $pizza->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Pizza created",
                    "data" => $pizza
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("CREATING PIZZA: ".$th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "error creating pizza"
                ],
                500
            );
        }
    }

    public function updatePizza(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'regex:/^[A-Za-z0-9]+$/',
                'type' => [
                    Rule::in(['fina', 'pan_pizza', 'original']),
                ],                
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }            
            
            $pizza = Pizza::find($id);

            if(!$pizza) {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Pizza doesn't exists",
                    ],
                    404
                ); 
            }

            $name = $request->input('name');
            $type = $request->input('type');

            if(isset($name)) {
                $pizza->name = $name;
            }

            if(isset($type)) {
                $pizza->type = $type;
            }
            
            $pizza->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Pizza updated",
                    "data" => $pizza
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function deletePizza(Request $request, $id)
    {
        try {

            Pizza::destroy($id);

            // otra manera de hacerlo
            // Pizza::query()->where('id', $id)->where('is_active', 0)->delete();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Pizza deleted"
                ],
                200
            );

        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function getPizzaById(Request $request, $id)
    {
        try {
            $pizza = Pizza::query()->find($id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Pizza deleted",
                    "data" => [
                        'id' => $pizza->id,
                        'name' => $pizza->name,
                        'type' => $pizza->type,
                        'is_active' => $pizza->is_active
                    ]
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }
}
