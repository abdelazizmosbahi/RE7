<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategorieController extends Controller
{
    /**
     * Add a new category.
     */
    public function addCategorie(Request $request)
    {
        // Validate input with uniqueness rule
        $request->validate([
            'titre' => 'required|string|max:255|unique:categories,titre', // Ensure titre is unique
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Validate the image file
        ], [
            'titre.unique' => 'This category title already exists. Please choose another.',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public'); // Save in the 'storage/app/public/uploads' folder
        } else {
            return response()->json(['message' => 'Image upload failed'], 400);
        }

        // Save category
        $categorie = Categorie::create([
            'titre' => $request->titre,
            'image' => $imagePath
        ]);

        return response()->json(['message' => 'Category created successfully', 'category' => $categorie], 201);
    }

    /**
     * Delete an existing category.
     */
    public function deleteCategorie(Request $request)
    {
        $id = $request->input('id'); // Get the 'id' from the form

        Log::info("Delete Categorie ID: $id");

        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $categorie->delete();
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }

    /**
     * Update an existing category.
     */
    public function updateCategorie(Request $request)
    {
        $id = $request->input('id'); // Get the 'id' from the form
        Log::info("Updating Categorie ID: $id", $request->all());

        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Validate input with uniqueness rule (exclude the current category ID)
        $validated = $request->validate([
            'titre' => 'required|string|max:255|unique:categories,titre,' . $id, // Ensure titre is unique
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Image is optional
        ], [
            'titre.unique' => 'This category title already exists. Please choose another.',
        ]);

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public'); // Save in the 'storage/app/public/uploads' folder
            $categorie->image = $imagePath; // Update the image field
        }

        // Update the category
        $categorie->update([
            'titre' => $validated['titre'],
            'image' => $categorie->image ?? $categorie->getOriginal('image') // Keep the old image if no new image is uploaded
        ]);

        return response()->json(['message' => 'Category updated successfully', 'category' => $categorie], 200);
    }

    /**
     * Fetch all categories.
     */
    public function getAllCategories()
    {
        Log::info('Fetching all categories');

        $categories = Categorie::all();
        return response()->json($categories, 200);
    }

    /**
     * Fetch a category by ID.
     */
    public function getCategorieById(Request $request)
    {
        $id = $request->input('id'); // Get the 'id' from the query string

        Log::info("Fetching Categorie ID: $id");

        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($categorie, 200);
    }
}