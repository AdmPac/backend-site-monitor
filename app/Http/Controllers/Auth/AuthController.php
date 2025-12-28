<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json([
                'success' => false,
                'message' => 'Неверный email или пароль',
            ], 401);
        }
        
        $user = Auth::user();
        
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('user_token')->plainTextToken,
            'success' => true,
        ], 401);
    }

    public function register(RegisterRequest $request)
    {
        $user = new User($request->validated());
        
        if ($user->save()) return response()->json([
            'user' => $user,
            'success' => true,
        ]);
        else return response()->json([
            'success' => false,
            'message' => 'Ошибка создания пользователя',
        ], 400);
    }
}