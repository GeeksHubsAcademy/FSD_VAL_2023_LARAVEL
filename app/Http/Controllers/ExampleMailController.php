<?php

namespace App\Http\Controllers;

use App\Mail\ExampleMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ExampleMailController extends Controller
{
    public function sendExampleEmail()
    {
        try {
            Mail::to('fernando@fernando.com')->send(new ExampleMail());

            return response()->json(
                [
                    "success" => true,
                    "message" => "Email sended"
                ]
            );
        } catch (\Throwable $th) {
            Log::error("eror sending Email: " . $th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "error sending email"
                ],
                500
            );
        }
    }
}
