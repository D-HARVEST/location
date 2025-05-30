<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Maison
 *
 * @property $id
 * @property $libelle
 * @property $Pays
 * @property $ville
 * @property $quartier
 * @property $adresse
 * @property $user_id
 * @property $jourPaiementLoyer
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Chambre[] $chambres
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Maison extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['libelle', 'Pays', 'ville', 'quartier', 'adresse', 'user_id', 'jourPaiementLoyer', 'moyenPaiement_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chambres()
    {
        return $this->hasMany(\App\Models\Chambre::class,'maison_id', 'id');
    }

    public function moyenPaiement()
    {
        return $this->belongsTo(\App\Models\MoyenPaiement::class, 'moyenPaiement_id', 'id');
    }

  
}
