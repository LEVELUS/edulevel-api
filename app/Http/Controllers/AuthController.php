<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule; 

class AuthController extends Controller
{
    // Inscription
    public function register(Request $request)
    {
$departements = [
        'Ouest', 'Sud-Est', 'Nord', 'Nord-Est', 'Artibonite',
        'Centre', 'Sud', "Grand'Anse", 'Nord-Ouest', 'Nippes',
    ];

    $request->validate([
        'first_name'        => 'required|string|max:255',
        'last_name'         => 'required|string|max:255',
        'email'             => 'required|string|email|unique:users',
        'password'          => 'required|string|min:8|confirmed',
        'localisation'      => ['nullable', Rule::in($departements)],
        'date_de_naissance' => ['nullable', 'date', 'before:today'],
    ]);

    $user = User::create([
        'first_name'        => $request->first_name,
        'last_name'         => $request->last_name,
        'email'             => $request->email,
        'password'          => Hash::make($request->password),
        'localisation'      => $request->localisation,
        'date_de_naissance' => $request->date_de_naissance,
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Inscription réussie',
        'token'   => $token,
        'user'    => $user,
    ], 201);
    }

    // Connexion
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants sont incorrects.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'token'   => $token,
            'user'    => $user,
        ]);
    }

    // Déconnexion
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie',
        ]);
    }
}