<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Recette;
use Illuminate\Http\Request;

class RateController extends Controller
{
    // Add a rate
    public function addRate(Request $request)
{
    $validated = $request->validate([
        'stars' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string',
        'recette_id' => 'required|exists:recettes,id',
    ]);

    Rate::create([
        'stars' => $validated['stars'],
        'comment' => $validated['comment'],
        'recette_id' => $validated['recette_id'],
        'status' => 'in progress', // Default status

        // 'user_id' => null, // Commented out for now
    ]);
    // After saving the rating, add the session variable to trigger the page reload
    session()->flash('rating_submitted', true);
    
    // Redirect back to the recette details page with a success message
    return redirect()->route('recette.details', ['id' => $validated['recette_id']])
                     ->with('success', 'Rate added successfully!');
}

    // Get rates for a recette
    public function getRatesByRecette($recetteId)
    {
        $recette = Recette::with('rates')->find($recetteId);

        if (!$recette) {
            return response()->json(['message' => 'Recette not found'], 404);
        }

        return response()->json($recette->rates, 200);
    }

// In RateController
public function deleteRate($id)
{
    $rate = Rate::find($id);

    if (!$rate) {
        return response()->json(['message' => 'Rate not found'], 404);
    }

    $rate->delete();

    return redirect()->back()->with('message', 'Rate deleted successfully!');
}



public function updateStatus(Request $request, $id)
{
    $rate = Rate::findOrFail($id);

    $validated = $request->validate([
        'status' => 'required|in:in progress,approved,deleted',
    ]);

    $rate->status = $validated['status'];
    $rate->save();

    return redirect()->route('admin.rate_management')->with('success', 'Rate status updated successfully.');
}

public function showRateManagement()
{
    // Eager load the 'recette' relationship so we can access the 'titre'
    $rates = Rate::with('recette')->get();

    return view('admin.rate_management', compact('rates'));
}

public function showRecetteDetails($id)
{
    // Fetch the recette with its approved rates
    $recette = Recette::with(['rates' => function ($query) {
        $query->where('status', 'approved');
    }])->find($id);

    if (!$recette) {
        return redirect()->route('userhome')->with('error', 'Recette not found');
    }

    // Calculate the average rating of the approved rates
    $approvedRates = $recette->rates;
    $averageRating = $approvedRates->avg('stars'); // Calculate average rating

    return view('user.recettedetails', compact('recette', 'averageRating', 'approvedRates'));
}


}
