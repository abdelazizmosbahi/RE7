<?php

namespace App\Http\Controllers;

use App\Models\SousCategorie;
use App\Models\Categorie;
use Illuminate\Http\Request;

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

    /**
     * Get all sous-categories
     */
    public function getAllSousCategories()
    {
        $sousCategories = SousCategorie::all();
        return response()->json($sousCategories, 200);
    }

    /**
     * Get sous-categorie by ID
     */
    public function getSousCategorieById($id)
    {
        $sousCategorie = SousCategorie::find($id);

        if (!$sousCategorie) {
            return response()->json(['message' => 'Sous-categorie not found'], 404);
        }

        return response()->json($sousCategorie, 200);
    }

    /**
     * Update sous-categorie
     */
    public function updateSousCategorie(Request $request, $id)
    {
        // Find the sous-categorie by ID
        $sousCategorie = SousCategorie::find($id);

        if (!$sousCategorie) {
            return response()->json(['message' => 'Sous-categorie not found'], 404);
        }

        // Validate the input
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        // Update the sous-categorie
        $sousCategorie->update($validated);

        return response()->json(['message' => 'Sous-categorie updated successfully', 'sous_categorie' => $sousCategorie], 200);
    }

    /**
     * Delete sous-categorie
     */
    public function deleteSousCategorie($id)
    {
        $sousCategorie = SousCategorie::find($id);

        if (!$sousCategorie) {
            return response()->json(['message' => 'Sous-categorie not found'], 404);
        }

        $sousCategorie->delete();

        return response()->json(['message' => 'Sous-categorie deleted successfully'], 200);
    }
}
