<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Email;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|integer',
            'restaurant_id' => 'nullable',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'id' => Str::uuid(),  // Génération d'un UUID
            'name' => $validated['name'],
            'role' => $validated['role'],
            'restaurant_id' => $validated['restaurant_id'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return response()->json([
            'response' => "success",
        ]);
    }
    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email', // Vérifiez que l'adresse email est valide
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Le mot de passe ou l\'adresse email est incorrect !'], // Correction
            ]);
        }

        session()->regenerate();
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'response' => "success",
            'token' => $token, // Ajouter le token à la réponse JSON
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        Auth::guard('web')->logout();
        return response()->json([
            'response' => "success",
        ]);
    }
}
