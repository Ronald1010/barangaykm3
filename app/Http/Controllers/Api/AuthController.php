<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\UserRequest;



class AuthController extends Controller
{
    /**
     * Login using the specified resource.
     */
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $response = [
        'user'  => $user,
        'token' => $user->createToken($request->email)->plainTextToken
    ];

    return $response;
}


    /**
     * Logout using the specified resource.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $response = [
            'message' => 'Logged out successfully'
        ];

        return $response;
    }
}
