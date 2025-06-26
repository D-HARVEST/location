<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HistoriquePaiement;
use App\Models\PaiementEspece;
use App\Models\Intervention;

/**
 * Class Louerchambre
 *
 * @property $id
 * @property $chambre_id
 * @property $user_id
 * @property $debutOccupation
 * @property $loyer
 * @property $statut
 * @property $cautionLoyer
 * @property $cautionElectricite
 * @property $cautionEau
 * @property $copieContrat
 * @property $jourPaiementLoyer
 * @property $created_at
 * @property $updated_at
 *
 * @property Chambre $chambre
 * @property User $user
 * @property HistoriquePaiement[] $historiquepaiements
 * @property Paiementenattente[] $paiementenattentes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class LouerChambre extends Model
{
    protected $table = 'louerchambres';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['chambre_id', 'user_id', 'debutOccupation', 'loyer', 'statut', 'cautionLoyer', 'cautionElectricite', 'cautionEau', 'copieContrat', 'jourPaiementLoyer'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chambre()
    {
        return $this->belongsTo(\App\Models\Chambre::class, 'chambre_id', 'id');
    }

    // Louerchambre.php
    public function historiquesPaiements()
    {
        return $this->hasMany(HistoriquePaiement::class, 'louerchambre_id');
    }

    public function paiements()
    {
        return $this->hasMany(PaiementEspece::class, 'louerchambre_id');
    }




    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function historiquepaiements()
    // {
    //     return $this->hasMany(\App\Models\Historiquepaiement::class, 'id', 'louerchambres_id');
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function paiementenattentes()
    // {
    //     return $this->hasMany(\App\Models\Paiementenattente::class, 'id', 'louerchambre_id');
    // }

}
