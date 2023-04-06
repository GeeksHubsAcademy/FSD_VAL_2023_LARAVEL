<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExampleMailController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/', function () {
    return "Bienvenidos al ultimo lunes";
});


// USERS examples without code
Route::get('/users', [UserController::class, 'getUsers']);
Route::post('/users', [UserController::class, 'createUser']);
Route::put('/users', [UserController::class, 'updateUser']);
Route::delete('/users', [UserController::class, 'deleteUser']);

// PIZZAS
Route::group([
    'middleware' => 'auth:sanctum'
], function () {
    Route::post('/pizzas', [PizzaController::class, 'createPizza']);
    Route::put('/pizzas/{id}', [PizzaController::class, 'updatePizza']);
    Route::delete('/pizzas/{id}', [PizzaController::class, 'deletePizza']);
    Route::post('/pizzas/add-ingredient/{id}', [PizzaController::class, 'addIngredientToPizzaId']);
});

Route::get('/pizzas', [PizzaController::class, 'getAllPizzas']);
Route::get('/pizzas/{id}', [PizzaController::class, 'getPizzaById']);
Route::get('/pizzas/reviews/{id}', [PizzaController::class, 'getPizzaByIdWithReviews']);
Route::get('/pizzas/ingredients/{id}', [PizzaController::class, 'getPizzaByIdWithIngredients']);

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => ['auth:sanctum', 'isAdmin']
], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
});

// REVIEWS
Route::group([
    'middleware' => 'auth:sanctum'
], function () {
    Route::post('/reviews', [ReviewController::class, 'createReview']);
});

Route::get('/send-email-example', [ExampleMailController::class, 'sendExampleEmail']);
