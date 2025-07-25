<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Paiementespece
 *
 * @property $id
 * @property $Motif
 * @property $Montant
 * @property $Date
 * @property $observation
 * @property $louerchambre_id
 * @property $created_at
 * @property $updated_at
 *
 * @property LouerChambre $louerchambre
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PaiementEspece extends Model
{
    protected $table = 'paiementespeces';
    protected $perPage = 20;
    protected $casts = [
    'moisPayes' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['Motif', 'Montant', 'Date', 'Mois', 'observation', 'louerchambre_id', 'statut', 'Motif_rejet', 'moisPayes'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function louerchambre()
    {
        return $this->belongsTo(\App\Models\LouerChambre::class, 'louerchambre_id', 'id');
    }


}
