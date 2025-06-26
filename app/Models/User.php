<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\LouerChambre;
use App\Models\MoyenPaiement;
use App\Models\Chambre;



/**
 * Class User
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 * @property $last_login_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    protected $perPage = 20;
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            "login_at" => "datetime",
            'password' => 'hashed',
        ];
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'npi', 'isActive', 'google_id', 'phone', 'image', 'last_login_at'];

    // User.php
    public function louerchambres()
    {
        return $this->hasMany(\App\Models\LouerChambre::class, 'user_id', 'id');
    }



    public function paiementsAbonnements()
    {
        return $this->hasMany(\App\Models\HistoriquePaiadm::class);
    }


    public function chambre()
    {
        return $this->belongsTo(Chambre::class, 'chambre_id');
    }

    public function louerchambre()
    {
        return $this->hasOne(LouerChambre::class)->latestOfMany();
    }

    // app/Models/User.php

    public function moyenpaiements()
    {
        return $this->hasMany(Moyenpaiement::class);
    }

    public function interventions()
    {
        return $this->hasManyThrough(
            \App\Models\Intervention::class,    // Le modèle final
            \App\Models\LouerChambre::class,    // Le modèle intermédiaire
            'user_id',                          // Clé étrangère sur le modèle Louerchambre
            'louerchambre_id',                  // Clé étrangère sur le modèle Intervention
            'id',                               // Clé locale sur le modèle User
            'id'                                // Clé locale sur le modèle Louerchambre
        );
    }

    public function historiquesPaiements()
    {

        return $this->hasManyThrough(
            \App\Models\Historiquepaiement::class,    // Le modèle final
            \App\Models\LouerChambre::class,    // Le modèle intermédiaire
            'user_id',                          // Clé étrangère sur le modèle Louerchambre
            'louerchambre_id',                  // Clé étrangère sur le modèle Historiquepaiement
            'id',                               // Clé locale sur le modèle User
            'id'                                // Clé locale sur le modèle Louerchambre
        );
    }
}
