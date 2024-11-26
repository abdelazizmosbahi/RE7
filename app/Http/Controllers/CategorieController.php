<?php
namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategorieController extends Controller
{
    public function addCategorie(Request $request)
    {
        Log::info('Add Categorie Request', $request->all());

        $request->validate([
            'titre' => 'required|string|max:255',
            'image' => 'required|string|max:500'
        ]);

        $categorie = Categorie::create([
            'titre' => $request->titre,
            'image' => $request->image
        ]);

        return response()->json($categorie, 201);
    }

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
    
    public function updateCategorie(Request $request)
{
    $id = $request->input('id'); // Get the 'id' from the form
    Log::info("Updating Categorie ID: $id", $request->all());

    $categorie = Categorie::find($id);

    if (!$categorie) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    // Validate the incoming request
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'image' => 'required|string|max:500'
    ]);

    // Update the category with the validated data
    $categorie->update($validated);

    return response()->json(['message' => 'Category updated successfully', 'category' => $categorie], 200);
}

    public function getAllCategories()
    {
        Log::info('Fetching all categories');

        $categories = Categorie::all();
        return response()->json($categories, 200);
    }

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
