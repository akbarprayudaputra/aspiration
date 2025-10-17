<?php

namespace App\Http\Controllers;

use App\Exceptions\CategoryException;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $categories = Category::all();

    if ($categories->isEmpty()) {
      throw new CategoryException("Category is empty.", 404);
    }

    return response()->json([
      "message" => "Successfully Get all Categories data.",
      "categories" => $categories,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255|unique:categories,name',
      'description' => 'string|max:255',
      'assigned_unit' => 'string|max:255',
    ]);

    $category = Category::create($validated);

    return response()->json([
      'message' => 'Category created successfully',
      'category' => $category,
    ], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Category $category)
  {
    echo "Hellow";
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Category $category)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    //
  }
}
