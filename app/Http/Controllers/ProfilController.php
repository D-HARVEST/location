<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ProfilController extends Controller
{
    public function show()
    {
        $userId = Auth::id();

    // Récupérer les sessions de l'utilisateur à partir de la table des sessions
    $sessions = DB::table('sessions')
        ->where('user_id', $userId)
        ->get();

        $sessions->transform(function ($session) {
            $agent = new Agent();
            $agent->setUserAgent($session->user_agent);

            // Construire la chaîne d'affichage désirée
            $session->device_browser = $agent->platform() . ' - ' . $agent->browser();
            $session->ip_address = $session->ip_address; // Récupérer l'IP pour l'affichage
            return $session;
        });
        return view('profil.mon-profil', compact('sessions'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('status', 'Profil mise a jour avec succès!');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->password,                                  );
        $user->save();

        return back()->with('status', 'Password mise a jour avec succès!');
    }


    public function logoutOtherSessions(Request $request)
    {

        $userId = Auth::user()->id;

        $currentSessionId = $request->session()->getId();

        DB::table('sessions')
        ->where('user_id', $userId)
        ->where('id', '!=', $currentSessionId) // Garder la session actuelle
        ->delete();


        return Redirect::route('profile.show')->with('status', 'Déconnexion des autres sessions réussie !');
    }


    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['error' => 'Le mot de passe ne correspond pas.']);

        }

        Auth::user()->delete();


        Auth::logout();

        return Redirect::route('home')->with('status', 'Compte supprimé avec succès!');
    }
}
