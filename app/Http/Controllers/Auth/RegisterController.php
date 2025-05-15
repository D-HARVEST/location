<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Redirection après l'inscription.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Constructeur : interdit l'accès aux utilisateurs connectés.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Valide les données d'inscription.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'npi' => ['nullable', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'exists:roles,name'],
        ], [
            'name.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être valide',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'role.required' => 'Le rôle est obligatoire',
            'role.exists' => 'Le rôle sélectionné est invalide',
        ]);
    }

    /**
     * Surcharge de la méthode register() pour gérer update ou création.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $data = $request->all();

        $user = User::where('email', $data['email'])->first();

        if ($user && $user->npi !== null && $user->npi !== $data['npi']) {
            return back()->withErrors([
                'npi' => 'NPI incorrect. Veuillez contacter votre propriétaire.',
            ])->withInput();
        }


        // Vérifie si le NPI est déjà utilisé par un autre utilisateur
        if (isset($data['npi'])) {
            $existingNpiUser = User::where('npi', $data['npi'])
                ->where('email', '!=', $data['email'])
                ->first();

            if ($existingNpiUser) {
                return back()->withErrors([
                    'npi' => 'Ce NPI est déjà utilisé par un autre compte.',
                ])->withInput();
            }
        }

        if ($user && $user->hasRole('locataire') && $data['role'] !== 'locataire') {
            return back()->withErrors([
                'role' => 'Cet utilisateur est déjà inscrit en tant que locataire. Veuillez choisir le rôle "locataire".',
            ])->withInput();
        }


        if (!$user && $data['role'] === 'locataire') {
            return back()->withErrors([
                'role' => 'Vous ne pouvez pas vous inscrire comme locataire. Veuillez contacter votre propriétaire.',
            ])->withInput();
        }

        if ($user) {
            // Mise à jour
            $user->update([
                'name' => $data['name'],
                // 'npi' => $data['npi'] ?? null,
                // 'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // Mise à jour du rôle
            $user->syncRoles([$data['role']]);
        } else {
            // Création
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'npi' => $data['npi'] ?? null,
                'password' => Hash::make($data['password']),
            ]);

            // Attribution du rôle
            $user->assignRole($data['role']);
        }

        Auth::login($user);

        return redirect($this->redirectPath());
    }

    /**
     * Cette méthode est conservée pour compatibilité, mais inutilisée ici.
     */
    protected function create(array $data)
    {
        // On n'utilise plus cette méthode, car on gère tout dans register()
    }
}
