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
            'npi' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'exists:roles,name'],
        ], [
            'name.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.unique' => 'L\'email est deja utilisé',
            'phone.required' => 'Le numéro de tелефone est obligatoire',
            'phone.unique' => 'Le numéro de tелефone est deja utilisé',
            'npi.required' => 'Le NPI est obligatoire',
            'npi.unique' => 'Le NPI est deja utilisé',
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



            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'npi' => $data['npi'] ?? null,
                'password' => Hash::make($data['password']),
            ]);

            // Attribution du rôle
            $user->assignRole($data['role']);


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
