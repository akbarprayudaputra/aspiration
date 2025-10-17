<?php

namespace App\Http\Controllers;

use App\Exceptions\UsersException;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $users = User::all();

    if ($users->isEmpty()) {
      throw new UsersException("Aspirations is empty.", 404);
    }

    return response()->json([
      "message" => "Successfully Get all Users data.",
      "users" => $users,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email',
      'password' => 'required|string|min:8|confirmed',
      'nim' => 'required|unique:users,nim|string|max:255',
      'role' => 'string|max:255',
    ]);

    $user = User::create($validated);

    return response()->json([
      'message' => 'User created successfully',
      'user' => $user,
    ], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $user = User::find($id);

    if (!$user) {
      throw new UsersException("User with id {$id} not found!", 404);
    }

    return response()->json([
      "message" => "Successfully Get User data.",
      "user" => $user,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validated = $request->validate([
      "name" => "sometimes|required|string|max:255",
      "email" => "sometimes|required|string|email|max:255|unique:users,email,{$id}",
      "password" => "sometimes|required|string|min:8|confirmed",
      "nim" => "sometimes|required|unique:users,nim,{$id}|string|max:255",
      "role" => "sometimes|string|max:255",
    ]);

    $user = User::find($id);
    if (!$user) {
      throw new UsersException("User with id {$id} not found!", 404);
    }

    $user->update($validated);

    return response()->json([
      "message" => "Successfully Update User data.",
      "user" => $user,
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $user = User::find($id);

    if (!$user) {
      throw new UsersException("User with id {$id} not found!", 404);
    }

    $user->delete();

    return response()->json([
      "message" => "Successfully Delete User data.",
      "user" => $user,
    ]);
  }
}
