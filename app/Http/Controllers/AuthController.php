<?php

namespace App\Http\Controllers;

use App\Generic\Generic;
use Illuminate\Http\Request;
use App\Services\UserService;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();
        $status = $user->status;
    
        return response()->json([
            'token' => $token,
            'status' => $status,
        ]);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return Generic::message(true, "Logouf realizado com sucesso!", "", 201);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro realizar logouf: " . $e->getMessage(), "", 500);
        }
    }
}

