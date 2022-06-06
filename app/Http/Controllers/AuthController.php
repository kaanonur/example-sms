<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $isAuth = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);

        if ($isAuth){
            $user = Auth::user();
            $response['token'] = $user->createToken('login')->accessToken;

            return response()->json($response, 200);
        } else {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
    }

    public function signup(Request $request)
    {
        $createUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($createUser) {
            return response()->json('success', 201);
        } else {
            return response()->json('User not created', 400);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
