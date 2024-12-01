<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SousCategorieController;
use App\Http\Controllers\RecetteController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// add product
Route::post('addCategorie', [CategorieController::class, 'addCategorie']);
// Delete category
Route::delete('deleteCategorie/{id}', [CategorieController::class, 'deleteCategorie']);
// Update category
Route::put('updateCategorie/{id}', [CategorieController::class, 'updateCategorie']);
// Get all categories
Route::get('getCategories', [CategorieController::class, 'getAllCategories']);
// Get category by ID
Route::get('getCategorie/{id}', [CategorieController::class, 'getCategorieById']);

// Add sous-categorie
Route::post('addSousCategorie', [SousCategorieController::class, 'addSousCategorie']);
// Get all sous-categories for a specific category
Route::get('getSousCategories/{categorieId}', [SousCategorieController::class, 'getSousCategoriesByCategorie']);
// Get a specific sous-categorie by ID
Route::get('getSousCategorie/{id}', [SousCategorieController::class, 'getSousCategorieById']);

//recette api
Route::post('addRecette', [RecetteController::class, 'addRecette']);
Route::delete('deleteRecette/{id}', [RecetteController::class, 'deleteRecette']);
Route::put('updateRecette/{id}', [RecetteController::class, 'updateRecette']);
Route::get('getAllRecettes', [RecetteController::class, 'getAllRecettes']);
Route::get('getRecetteById/{id}', [RecetteController::class, 'getRecetteById']);
Route::get('recipesaccepted/{id}', [RecetteController::class, 'getAcceptedRecipes']);
Route::get('recipesRefusée/{id}', [RecetteController::class, 'getRefuserRecipes']);
Route::get('recipesEnCours/{id}', [RecetteController::class, 'getEnCoursRecipes']);
Route::put('recipes/{id}/{status}', [RecetteController::class, 'updateRecipeStatus']);


//sous categorie api
Route::post('addSousCategorie', [SousCategorieController::class, 'addSousCategorie']);
Route::get('sousCategories', [SousCategorieController::class, 'getAllSousCategories']);
Route::get('sousCategorie/{id}', [SousCategorieController::class, 'getSousCategorieById']);
Route::put('updateSousCategorie/{id}', [SousCategorieController::class, 'updateSousCategorie']);
Route::delete('deleteSousCategorie/{id}', [SousCategorieController::class, 'deleteSousCategorie']);
