<?php

namespace App\Http\Controllers\Auth;

use Throwable; // Correction de Trowable en Throwable
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::where('email', $google_user->getEmail())->first();

            if (!$user) {
                // Si l'utilisateur n'existe pas, le créer

                // Récupérer l'URL de l'image de profil
                $imageUrl = $google_user->getAvatar();

                // Télécharger l'image
                $imageContents = file_get_contents($imageUrl);
                $imageName = Str::random(10) . '.jpg'; // Générer un nom de fichier unique
                Storage::disk('public')->put("images/{$imageName}", $imageContents); // Stocker l'image

                // Enregistrer le chemin dans la base de données
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'image' => $imageName, // Stocker le nom de l'image
                ]);

                Auth::login($new_user);
                return redirect()->intended('home');
            } else {
                // Si l'utilisateur existe, le connecter
                Auth::login($user);
                return redirect()->intended('home');
            }

        } catch (Throwable $th) {
            dd('Something went wrong: ' . $th->getMessage());
        }
    }
}
