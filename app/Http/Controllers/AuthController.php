<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //ToDo Try catch
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6|max:12',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            "success" => true,
            "message" => "User registered successfully",
            'data' => $user,
            "token" => $token
        ];

        return response()->json(
            $res,
            Response::HTTP_CREATED
        );
    }

    public function login(Request $request)
    {

        //ToDo TryCatch 
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::query()->where('email', $request['email'])->first();
        // Validamos si el usuario existe
        if (!$user) {
            return response(
                ["success" => false, "message" => "Email or password are invalid",],
                Response::HTTP_NOT_FOUND
            );
        }
        // Validamos la contraseña
        if (!Hash::check($request['password'], $user->password)) {
            return response(["success" => true, "message" => "Email or password are invalid"], Response::HTTP_NOT_FOUND);
        }

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            "success" => true,
            "message" => "User logged successfully",
            "token" => $token
        ];

        return response()->json(
            $res,
            Response::HTTP_ACCEPTED
        );
    }
}
