<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Categorie;
// use App\Models\SousCategorie;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    public function addRecette(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'sous_categorie_id' => 'required|exists:sous_categories,id',
            'ingredients' => 'required|string',
            'methode_preparation' => 'required|string',
            'informations_complementaire' => 'nullable|string',
            'status' => 'nullable|string'
        ]);

        // Create the Recette
        $recette = Recette::create($validated);

        // Return success response
        return response()->json([
            'message' => 'Recette created successfully',
            'recette' => $recette
        ], 201);
    }

    public function deleteRecette($id)
    {
        $recette = Recette::find($id);

        if (!$recette) {
            return response()->json(['message' => 'Recette not found'], 404);
        }

        $recette->delete();

        return response()->json(['message' => 'Recette deleted successfully'], 200);
    }

    public function updateRecette(Request $request, $id)
    {
        $recette = Recette::find($id);

        if (!$recette) {
            return response()->json(['message' => 'Recette not found'], 404);
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'ingredients' => 'required|string',
            'methode_preparation' => 'required|string',
            'informations_complementaire' => 'nullable|string',
            'status' =>'nullable|string'

        ]);

        $recette->update($validated);

        return response()->json(['message' => 'Recette updated successfully', 'recette' => $recette], 200);
    }

    public function getAllRecettes()
    {
        $recettes = Recette::all();

        return response()->json($recettes, 200);
    }

    public function getRecetteById($id)
    {
        $recette = Recette::find($id);

        if (!$recette) {
            return response()->json(['message' => 'Recette not found'], 404);
        }

        return response()->json($recette, 200);
    }


    public function getAcceptedRecipes()
{
    $recipes = Recette::where('status', 'acceptée')->get();
    return response()->json($recipes, 200);
}
public function getEnCoursRecipes()
{
    $recipes = Recette::where('status', 'en cours')->get();
    return response()->json($recipes, 200);
}
public function getRefuserRecipes()
{
    $recipes = Recette::where('status', 'refusée')->get();
    return response()->json($recipes, 200);
}


public function updateRecipeStatus(Request $request, $id)
{
    // Trouver la recette par son ID
    $recipe = Recette::find($id);

    if (!$recipe) {
        return response()->json(['message' => 'Recette introuvable'], 404);
    }

    // Valider le statut passé dans la requête
    $validated = $request->validate([
        'status' => 'required|in:acceptée,en cours,refusée',
    ]);

    // Vérifier si le statut actuel est déjà celui demandé
    if ($recipe->status === $validated['status']) {
        return response()->json(['message' => 'Le statut est déjà ' . $validated['status']], 400);
    }

    // Mettre à jour le statut de la recette
    $recipe->update(['status' => $validated['status']]);

    return response()->json([
        'message' => 'Statut mis à jour avec succès',
        'recette' => $recipe,
    ], 200);
}




}
