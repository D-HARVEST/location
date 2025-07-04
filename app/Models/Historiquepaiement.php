<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LouerChambre;

/**
 * Class Historiquepaiement
 *
 * @property $id
 * @property $louerchambres_id
 * @property $datePaiement
 * @property $quittanceUrl
 * @property $montant
 * @property $modePaiement
 * @property $idTransaction
 * @property $moisPaiement
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property LouerChambre $louerchambre
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class HistoriquePaiement extends Model
{

    protected $table = 'historiquepaiements';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['louerchambre_id', 'datePaiement', 'quittanceUrl', 'montant', 'modePaiement', 'idTransaction', 'moisPaiement', 'nb_mois', 'user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function louerchambre()
    {
        return $this->belongsTo(LouerChambre::class, 'louerchambre_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

}
