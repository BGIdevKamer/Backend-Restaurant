<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategorieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentification
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

// restaurant
Route::prefix('restaurant')->middleware(['auth:sanctum'])->group(function () {
    Route::post('/store', [RestaurantController::class, 'store']);
    Route::post('/update', [RestaurantController::class, 'update']);
    Route::get('/get/{id}', [RestaurantController::class, 'get']);
});

// categorie
Route::prefix('categorie')->middleware(['auth:sanctum'])->group(function () {
    Route::post('/store', [CategorieController::class, 'store']); // enregister une categorie 
    Route::get('/get', [CategorieController::class, 'index']); // afficher  toute les categorie pour le user connecter
    Route::get('/get/{id}', [CategorieController::class, 'show']); // afficher une categorie en fonction de son id
    Route::put('/update/{id}', [CategorieController::class, 'update']); // Modiffier une categorie 
    Route::put('/delete/{id}', [CategorieController::class, 'destroy']); // Supprimer une categorie 
});

// Route::post('/store', [RestaurantController::class, 'store']);
