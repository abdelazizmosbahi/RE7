<?php

namespace App\Http\Controllers;

use App\Models\SousCategorie;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SousCategorieController extends Controller
{
    /**
     * Add a new sous-categorie
     */
    public function addSousCategorie(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id' // Ensure the categorie_id exists
        ]);

        // Create the SousCategorie
        $sousCategorie = SousCategorie::create($validated);

        // Retrieve the associated category title
        $categorie = Categorie::find($sousCategorie->categorie_id);

        // Return success response with associated category title
        return response()->json([
            'message' => 'Sous-categorie created successfully',
            'sous_categorie' => $sousCategorie,
            'categorie_title' => $categorie->titre
        ], 201);
    }

    public function getAllSousCategories()
    {
        // Retrieve all sous categories
        $sousCategories = SousCategorie::all();
    
        // Return the sous categories in a JSON format
        return response()->json($sousCategories, 200);
    }
    

    public function getSousCategorieById(Request $request)
{
    $id = $request->input('id');
    $sousCategorie = SousCategorie::find($id);

    if (!$sousCategorie) {
        return response()->json(['message' => 'Sous-categorie not found'], 404);
    }

    return response()->json($sousCategorie, 200);
}

    

public function updateSousCategorie(Request $request)
{
    $id = $request->input('id'); // Get the 'id' from the form

    Log::info("Updating Sous Categorie ID: $id", $request->all());

    // Find the SousCategorie by ID
    $sousCategorie = SousCategorie::find($id);

    // Check if the sous-categorie exists
    if (!$sousCategorie) {
        return response()->json(['message' => 'Sous-categorie not found'], 404);
    }

    // Validate the incoming request
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'image' => 'required|string|max:255',
        'categorie_id' => 'required|exists:categories,id', // Ensure the category ID is valid
    ]);

    // Update the SousCategorie with validated data
    $sousCategorie->update($validated);

    return response()->json(['message' => 'Sous-categorie updated successfully', 'sous_categorie' => $sousCategorie], 200);
}


    public function deleteSousCategorie(Request $request)
    {
        $id = $request->input('id'); // Get the 'id' from the form
    
        Log::info("Delete Sous Categorie ID: $id");
    
        $sousCategorie = SousCategorie::find($id);
    
        if (!$sousCategorie) {
            return response()->json(['message' => 'Sous-categorie not found'], 404);
        }
    
        $sousCategorie->delete();
        return response()->json(['message' => 'Sous-categorie deleted successfully'], 200);
    }

    public function showAddSousCategorieForm()
{
    // Fetch all categories to populate the dropdown
    $categories = Categorie::all();

    // Return the view with the categories data
    return view('admin.SousCategorieAdmin', compact('categories'));
}

}
