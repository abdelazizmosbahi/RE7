<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Categorie;
use App\Models\SousCategorie;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
//     public function addRecette(Request $request)
// {
//     // Validation logic (if any)
    
//     // Example: Save the recette
//     $recette = new Recette();
//     $recette->categorie_id = $request->categorie_id;
//     $recette->sous_categorie_id = $request->sous_categorie_id;
//     $recette->titre = $request->titre;
//     $recette->ingredients = $request->ingredients;
//     $recette->methode_preparation = $request->methode_preparation;
//     $recette->informations_complementaire = $request->informations_complementaire;

//     if ($request->hasFile('image')) {
//         $recette->image = $request->file('image')->store('');
//     }

//     $recette->save();

//     // Always return a JSON response
//     return response()->json(['message' => 'Recette added successfully!'], 200);
// }
public function addRecette(Request $request)
{
    // Validation logic (if any)
    
    // Example: Save the recette
    $recette = new Recette();
    $recette->categorie_id = $request->categorie_id;
    $recette->sous_categorie_id = $request->sous_categorie_id;
    $recette->titre = $request->titre;
    $recette->ingredients = $request->ingredients;
    $recette->methode_preparation = $request->methode_preparation;
    $recette->informations_complementaire = $request->informations_complementaire;

    // Handle image upload and store it in the 'public' disk in 'recettes_images' folder
    if ($request->hasFile('image')) {
        // Store image in the 'recettes_images' folder within the 'public' disk
        $recette->image = $request->file('image')->store('recettes_images', 'public');
    }

    $recette->save();

    // Always return a JSON response
    return response()->json(['message' => 'Recette added successfully!'], 200);
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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Added validation for image
        'ingredients' => 'required|string',
        'methode_preparation' => 'required|string',
        'informations_complementaire' => 'nullable|string',
        'status' => 'nullable|string'
    ]);

    // Handle the image if uploaded
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('recettes', 'public');
        $validated['image'] = $imagePath; // Update the validated array with the image path
    }

    // Update the recette with validated data (including image if uploaded)
    $recette->update($validated);

    return response()->json(['message' => 'Recette updated successfully', 'recette' => $recette], 200);
}


    public function getAllRecettes()
{
    $recettes = Recette::with(['categorie', 'sousCategorie', 'rates'])->get();

    return response()->json($recettes, 200);
}

    


    // public function getRecetteById($id)
    // {
    //     $recette = Recette::find($id);

    //     if (!$recette) {
    //         return response()->json(['message' => 'Recette not found'], 404);
    //     }

    //     return response()->json($recette, 200);
    // }
    public function getRecetteById($id)
{
    $recette = Recette::with('rates')->find($id);

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

// Fetch sous-categories based on category ID
public function getSousCategoriesByCategoryId($categoryId)
{
    // Fetch all sous-categories related to the given category ID
    $sousCategories = SousCategorie::where('categorie_id', $categoryId)->get();

    if ($sousCategories->isEmpty()) {
        return response()->json(['message' => 'No sous-categories found for this category'], 404);
    }

    return response()->json($sousCategories, 200);
}


public function consulterListRecette()
{
    // Fetch the user's recipes (adjust according to your models and relationships)
    $user = auth()->user();  // Get the authenticated user
    $recettes = $user->recettes;  // Assuming there’s a 'recettes' relationship defined in the User model

    return view('user.ConsulterListRecette', compact('recettes'));
}

// RecetteController.php
public function listRecettes()
{
    $recettes = Recette::all();  // Fetch all recettes from the database
    return view('user.recettes', compact('recettes'));  // Pass the recettes to the view
}

public function showEditForm($id)
{
    $recette = Recette::findOrFail($id);
    $categories = Categorie::all();  // Or adjust based on your model
    $sousCategories = SousCategorie::all();  // Or adjust based on your model

    return view('user.ModifierRecette', compact('recette', 'categories', 'sousCategories'));
}

public function showRecette($id)
{
    $recette = Recette::find($id);

    if (!$recette) {
        return redirect()->route('recette.list')->with('error', 'Recette not found');
    }

    return view('user.ConsulterrecetteUser', compact('recette'));
}
public function mesRecettes()
{
    // Fetch all recipes by status
    $accepted = Recette::where('status', 'acceptée')->get();
    $enCours = Recette::where('status', 'en cours')->get();
    $refused = Recette::where('status', 'refusée')->get();

    return view('user.MesRecettesCons', compact('accepted', 'enCours', 'refused'));
}

// public function showRecetteDetails($id)
// {
//     $recette = Recette::find($id);

//     if (!$recette) {
//         return redirect()->route('userhome')->with('error', 'Recette not found');
//     }

//     return view('user.recettedetails', compact('recette'));
// }
public function showRecetteDetails($id)
{
    $recette = Recette::with('rates')->find($id); // Eager load the rates

    if (!$recette) {
        return redirect()->route('userhome')->with('error', 'Recette not found');
    }

    // Calculate the average rating (moyenne)
    $averageRating = $recette->rates->avg('stars'); // Calculates average stars

    return view('user.recettedetails', compact('recette', 'averageRating'));
}



public function rate(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $recette = Recette::find($id);
    if (!$recette) {
        return redirect()->route('userhome')->with('error', 'Recette not found.');
    }

    // Save the rating (this assumes you have a ratings table or column)
    $recette->ratings()->create([
        'rating' => $request->rating,
        'user_id' => auth()->id(), // Assuming user is logged in
    ]);

    return redirect()->back()->with('success', 'Thank you for rating!');
}


}
