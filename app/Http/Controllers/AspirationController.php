<?php

namespace App\Http\Controllers;

use App\Exceptions\AspirationException;
use App\Models\Aspiration;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $aspirations = Aspiration::with(['category', 'user'])->get();

    if ($aspirations->isEmpty()) {
      throw new AspirationException("Aspirations is empty.", 404);
    }

    return response()->json([
      "message" => "Successfully Get all Aspirations data.",
      "aspirations" => $aspirations,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
      'is_anonymous' => 'boolean',
      'category_id' => 'required|exists:categories,id',
      'user_id' => 'required|exists:users,id',
      'status' => 'string|max:255',
    ]);

    $aspiration = Aspiration::create($validated);

    return response()->json([
      'message' => 'Aspiration created successfully',
      'aspiration' => $aspiration,
    ], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Aspiration $aspiration)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Aspiration $aspiration)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Aspiration $aspiration)
  {
    //
  }
}
