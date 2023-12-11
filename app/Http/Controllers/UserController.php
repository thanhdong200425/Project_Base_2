<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        if ($users) {
            return response()->json([
                'status' => 200,
                'users' => $users
            ], 200);
        }

        return response()->json([
            'status' => 500,
            'message' => 'User not found'
        ], 500);
    }

    public function sign_in(Request $request)
    {
        $validationData = $request->validate([
            'email' => ['required', 'unique:users,email'],
            'password' => ['required']
        ]);

        if ($validationData) {
            $user = User::where('email', '=', $request->email)->get();
            return response()->json([
                'user' => $user
            ], 200);
        }

        return response()->json([
            'status' => 404,
            'message' => 'User not found'
        ], 404);
    }

    
}
