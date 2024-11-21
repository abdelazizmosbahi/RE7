<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function addCategorie(Request $request)
    {
        // Validate input
        $request->validate([
            'titre' => 'required|string|max:255',
            'image' => 'required|string|max:50'
        ]);
    
        $categorie = Categorie::create([
            'titre' => $request->titre,
            'image' => $request->image
        ]);
    
        return response($categorie, 201);
    }
    
    public function deleteCategorie($id)
{
    // Find the category by ID
    $categorie = Categorie::find($id);

    // Check if the category exists
    if (!$categorie) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    // Delete the category
    $categorie->delete();

    // Return a success response
    return response()->json(['message' => 'Category deleted successfully'], 200);
}


public function updateCategorie(Request $request, $id)
{
    // Find the category by ID
    $categorie = Categorie::find($id);

    // Check if the category exists
    if (!$categorie) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    // Validate the incoming request
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'image' => 'required|string|max:50'
    ]);

    // Update the category with the validated data
    $categorie->update($validated);

    // Return a success response
    return response()->json(['message' => 'Category updated successfully', 'category' => $categorie], 200);
}

// public function getAllCategories()
// {
//     // Retrieve all categories
//     $categories = Categorie::all();

//     // Return the categories as a JSON response
//     return response()->json($categories, 200);
// }
public function getAllCategories()
{
    $categories = Categorie::all(); // Retrieve all categories
    return view('admin.CategorieAdmin', compact('categories')); // Pass the categories data to the view
}


public function getCategorieById($id)
{
    // Find the category by ID
    $categorie = Categorie::find($id);

    // If the category doesn't exist, return a 404 response
    if (!$categorie) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    // Return the category as a JSON response
    return response()->json($categorie, 200);
}

}
