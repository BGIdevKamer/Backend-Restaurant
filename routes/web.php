<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('login', function () {
//     $user = User::firstOrFail(); // Récupérer le premier utilisateur ou échouer
//     return $user->createToken('auth_token')->plainTextToken; // Créer un token pour cet utilisateur
// })->name('login');
