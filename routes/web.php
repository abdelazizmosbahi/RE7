<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SousCategorieController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\RateController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/userhome', function () {
    return view('user.userhome');
});
Route::get('/admin/rates', function () {
    return view('admin.rate_management');
})->name('admin.rate_management');

Route::get('/userhome', [CategorieController::class, 'showUserHome']);
Route::get('/user/recette-details/{id}', [RecetteController::class, 'showRecetteDetails'])->name('recette.details');
Route::post('/rate/add', [RateController::class, 'addRate'])->name('rate.add');
Route::get('/admin/rates', [RateController::class, 'showRateManagement'])->name('admin.rate_management');
Route::put('/rate/update-status/{id}', [RateController::class, 'updateStatus'])->name('rate.updateStatus');


// Admin routes
Route::get('/admin/categorie', function () {
    return view('admin.CategorieAdmin');
});


Route::get('/admin/consulter-list-recette', function () {
    return view('admin.ConsulterListRecette');
});

Route::get('/admin/consulter-recette', function () {
    return view('admin.ConsulterRecetteAdmin');
});

Route::get('/admin/modifier-recette', function () {
    return view('admin.ModifierRecetteAdmin');
});

Route::get('/admin/souscategorie', function () {
    return view('admin.SousCategorieAdmin');
});



// User Routes
// Route::get('/user/ajouter-recette', function () {
//     return view('user.AjouterRecette');
// });
// User Routes for Recette
Route::get('/user/ajouter-recette', function () {
    return view('user.AjouterRecette');
});
Route::get('/user/modifier-recette', function () {
    return view('user.ModifierRecette');
});

Route::get('/user/consulter-list-recette', function () {
    return view('user.ConsulterListRecette');
});

Route::get('/user/consulter-recette', function () {
    return view('user.ConsulterrecetteUser');
});

Route::get('/user/mes-recettes', function () {
    return view('user.MesRecettesCons');
});

Route::get('/user/souscategorie', function () {
    return view('user.SousCategorieUser');
});


Route::get('/user/categorie', function () {
    return view('user.CategorieUser');
});


// Admin API Routes for Categories

Route::post('/admin/add-categorie', [CategorieController::class, 'addCategorie']);
Route::delete('/admin/delete-categorie', [CategorieController::class, 'deleteCategorie']);
Route::put('/admin/update-categorie', [CategorieController::class, 'updateCategorie']);
Route::get('/admin/get-all-categories', [CategorieController::class, 'getAllCategories']);
Route::get('/admin/get-categorie-by-id', [CategorieController::class, 'getCategorieById']);
Route::get('/categories/{category_id}/souscategories', [CategorieController::class, 'getSousCategoriesByCategoryId']);
Route::get('/admin/categorie/{id}', [CategorieController::class, 'show'])->name('categorie.show');
Route::get('/admin/categorie', [CategorieController::class, 'index'])->name('categorie.index');


// sub categorie admin routes
Route::post('/admin/add-sous-categorie', [SousCategorieController::class, 'addSousCategorie']);
Route::put('/admin/update-sous-categorie', [SousCategorieController::class, 'updateSousCategorie']);
Route::delete('/admin/delete-sous-categorie', [SousCategorieController::class, 'deleteSousCategorie']);
Route::get('/admin/get-all-sous-categories', [SousCategorieController::class, 'getAllSousCategories']);
Route::get('/admin/get-sous-categorie-by-id', [SousCategorieController::class, 'getSousCategorieById']);
Route::get('/admin/get-sous-categorie-by-id/{id}', [SousCategorieController::class, 'getSousCategorieById']);
Route::get('/admin/add-sous-categorie', [SousCategorieController::class, 'showAddSousCategorieForm']);
Route::get('/admin/get-sous-categories/{categoryId}', [RecetteController::class, 'getSousCategoriesByCategoryId']);
Route::get('/admin/souscategorie', [SousCategorieController::class, 'index'])->name('sous-categorie.index');
Route::get('/admin/souscategorie/{id}', [SousCategorieController::class, 'show'])->name('souscategorie.show');


// Route::post('/recettes', [RecetteController::class, 'addRecette'])->name('recette.store');

// Route::post('/user/addRecette', [RecetteController::class, 'addRecette'])->name('recette.add');
Route::delete('/admin/deleteRecette/{id}', [RecetteController::class, 'deleteRecette']);
Route::put('/admin/updateRecette/{id}', [RecetteController::class, 'updateRecette']);
Route::get('/admin/getAllRecettes', [RecetteController::class, 'getAllRecettes']);
Route::get('/admin/getRecetteById/{id}', [RecetteController::class, 'getRecetteById']);
Route::get('/admin/recipesaccepted/{id}', [RecetteController::class, 'getAcceptedRecipes']);
Route::get('/admin/recipesRefusée/{id}', [RecetteController::class, 'getRefuserRecipes']);
Route::get('/admin/recipesEnCours/{id}', [RecetteController::class, 'getEnCoursRecipes']);
Route::put('/admin/recipes/{id}/{status}', [RecetteController::class, 'updateRecipeStatus']);


Route::post('/recette/update-status/{id}', [RecetteController::class, 'updateRecipeStatus'])->name('recette.update.status');


//// user

// Route::post('/user/addRecette', [RecetteController::class, 'addRecette'])->name('recette.add');
Route::post('/user/ajouter-recette', [RecetteController::class, 'addRecette'])->name('recette.add');
Route::get('/user/recettes', [RecetteController::class, 'getAllRecettes'])->name('recettes.list');
Route::get('/recette/delete/{id}', [RecetteController::class, 'deleteRecette'])->name('recette.delete');
Route::get('/recette/edit/{id}', [RecetteController::class, 'showEditForm'])->name('recette.edit');
Route::post('/recette/update/{id}', [RecetteController::class, 'updateRecette'])->name('recette.update');


// User Route for fetching sous-categories by category ID
Route::get('/user/get-sous-categories-by-category/{categoryId}', [RecetteController::class, 'getSousCategoriesByCategoryId']);
// Route to view recipe details
Route::get('/recette/detail/{id}', [RecetteController::class, 'showRecette'])->name('recette.detail');
// Route to show the user's recipes filtered by status
Route::get('/user/mes-recettes', [RecetteController::class, 'mesRecettes'])->name('user.mesRecettes');
