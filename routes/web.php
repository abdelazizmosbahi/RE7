<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/welcome', function () {
    return view('welcome');
});



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
Route::get('/user/ajouter-recette', function () {
    return view('user.AjouterRecette');
});

Route::get('/user/categorie', function () {
    return view('user.CategorieUser');
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



// Admin API Routes for Categories

Route::post('/admin/add-categorie', [CategorieController::class, 'addCategorie']);
Route::delete('/admin/delete-categorie', [CategorieController::class, 'deleteCategorie']);
Route::put('/admin/update-categorie', [CategorieController::class, 'updateCategorie']);
Route::get('/admin/get-all-categories', [CategorieController::class, 'getAllCategories']);
Route::get('/admin/get-categorie-by-id', [CategorieController::class, 'getCategorieById']);
