<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Paiementenattente
 *
 * @property $id
 * @property $louerchambre_id
 * @property $dateLimite
 * @property $montant
 * @property $created_at
 * @property $updated_at
 *
 * @property Louerchambre $louerchambre
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Paiementenattente extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['louerchambre_id', 'dateLimite', 'montant', 'statut'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function louerchambre()
    {
        return $this->belongsTo(\App\Models\Louerchambre::class, 'louerchambre_id', 'id');
    }

}
