<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
      throw new AuthException("Credentials are not match!", 401);
    }

    $token =  $user->createToken("X-ASPRTN-{$request->email}")->plainTextToken;

    return response()->json([
      'message' => 'Login successful',
      'user' => $user,
      'token' => $token,
    ], 200);
  }

  public function register(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'nim' => 'required|unique:users,nim|string|max:255',
      'role' => 'string|max:255',
    ]);

    $validated['password'] = Hash::make($validated['password']);

    $user = User::create($validated);

    return response()->json([
      'message' => 'User registered successfully',
      'user' => $user,
    ], 201);
  }

  public function logout(Request $request)
  {
    $request->user()->tokens()->delete();

    return response()->json([
      'message' => 'Logged out successfully',
    ], 200);
  }
}
