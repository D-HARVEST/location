<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Intervention
 *
 * @property $id
 * @property $libelle
 * @property $louerchambre_id
 * @property $description
 * @property $statut
 * @property $created_at
 * @property $updated_at
 *
 * @property Louerchambre $louerchambre
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Intervention extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['libelle', 'louerchambre_id', 'description', 'statut'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function louerchambre()
    {
        return $this->belongsTo(\App\Models\Louerchambre::class, 'louerchambre_id', 'id');
    }

}
