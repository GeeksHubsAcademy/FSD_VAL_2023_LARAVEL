<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        return "Get all users";
    }

    public function createUser()
    {
        return "Create user";
    }

    public function updateUser()
    {
        return "Update user";
    }

    public function deleteUser()
    {
        return "Delete user";
    }
}
