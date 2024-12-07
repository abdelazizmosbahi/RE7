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
            'titre' => 'required|string|max:255|unique:sous_categories,titre', // Ensure titre is unique
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
            'categorie_id' => 'required|exists:categories,id' // Ensure the categorie_id exists
        ], [
            'titre.unique' => 'This sous-categorie title already exists. Please choose another.',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public'); // Save in the 'storage/app/public/uploads' folder
        } else {
            return response()->json(['message' => 'Image upload failed'], 400);
        }

        // Create the SousCategorie with validated data and image path
        $sousCategorie = SousCategorie::create([
            'titre' => $validated['titre'],
            'image' => $imagePath,
            'categorie_id' => $validated['categorie_id']
        ]);

        // Retrieve the associated category title
        $categorie = Categorie::find($sousCategorie->categorie_id);

        // Return success response with associated category title
        return response()->json([
            'message' => 'Sous-categorie created successfully',
            'sous_categorie' => $sousCategorie,
            'categorie_title' => $categorie->titre
        ], 201);
    }

    // /**
    //  * Get all sous categories
    //  */
    // public function getAllSousCategories()
    // {
    //     // Retrieve all sous categories
    //     $sousCategories = SousCategorie::all();
    
    //     // Return the sous categories in a JSON format
    //     return response()->json($sousCategories, 200);
    // }
    public function getAllSousCategories() {
    $sousCategories = SousCategorie::with('categorie')->get();  // Assuming you have a relationship defined

    // Format the response to include category title
    return response()->json($sousCategories->map(function ($sousCategorie) {
        return [
            'id' => $sousCategorie->id,
            'titre' => $sousCategorie->titre,
            'image' => $sousCategorie->image,
            'categorie_title' => $sousCategorie->categorie->titre,  // Fetching the related category title
        ];
    }));
}

    /**
     * Get a sous categorie by ID
     */
    public function getSousCategorieById(Request $request)
    {
        $id = $request->input('id');
        $sousCategorie = SousCategorie::find($id);

        if (!$sousCategorie) {
            return response()->json(['message' => 'Sous-categorie not found'], 404);
        }

        return response()->json($sousCategorie, 200);
    }

    /**
     * Update a sous-categorie
     */
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

        // Validate the incoming request, ensuring uniqueness of title (exclude the current category ID)
        $validated = $request->validate([
            'titre' => 'required|string|max:255|unique:sous_categories,titre,' . $id, // Ensure titre is unique
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional during update
            'categorie_id' => 'required|exists:categories,id', // Ensure the category ID is valid
        ], [
            'titre.unique' => 'This sous-categorie title already exists. Please choose another.',
        ]);

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public'); // Save in the 'storage/app/public/uploads' folder
            $sousCategorie->image = $imagePath; // Update the image field
        }

        // Update the SousCategorie with validated data
        $sousCategorie->update([
            'titre' => $validated['titre'],
            'image' => $sousCategorie->image ?? $sousCategorie->getOriginal('image'), // Keep old image if no new image is uploaded
            'categorie_id' => $validated['categorie_id']
        ]);

        return response()->json(['message' => 'Sous-categorie updated successfully', 'sous_categorie' => $sousCategorie], 200);
    }

    /**
     * Delete a sous-categorie
     */
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

    /**
     * Show form to add sous-categorie
     */
    public function showAddSousCategorieForm()
    {
        // Fetch all categories to populate the dropdown
        $categories = Categorie::all();

        // Return the view with the categories data
        return view('admin.SousCategorieAdmin', compact('categories'));
    }

    public function show($id)
    {
        // Fetch the sous-categorie by ID
        $sousCategorie = SousCategorie::findOrFail($id);
    
        // Pass the sous-categorie data to the view
        return view('admin.ConsulterSousCategorie', compact('sousCategorie'));
    }

    public function index()
{
    $sousCategories = SousCategorie::all(); // Fetch sous-categories from the database
    return view('admin.SousCategorieAdmin', compact('sousCategories')); // Load the view with data
}

    
}
