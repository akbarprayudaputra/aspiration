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
  public function show(int $id)
  {
    $category = Category::with('aspirations')->find($id);

    if (!$category) {
      throw new CategoryException("Category not found.", 404);
    }

    return response()->json([
      "message" => "Successfully Get Category data.",
      "category" => $category,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, int $id)
  {
    $category = Category::find($id);

    if (!$category) {
      throw new CategoryException("Category not found.", 404);
    }

    $validated = $request->validate([
      'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $category->id,
      'description' => 'sometimes|string|max:255',
      'assigned_unit' => 'sometimes|string|max:255',
    ]);

    $category->update($validated);

    return response()->json([
      'message' => 'Category updated successfully',
      'category' => $category,
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $category = Category::find($id);

    if (!$category) {
      throw new CategoryException("Category not found.", 404);
    }

    $category->delete();

    return response()->json([
      'message' => 'Category deleted successfully',
    ]);
  }
}
