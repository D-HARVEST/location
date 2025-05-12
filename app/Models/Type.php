<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Type
 *
 * @property $id
 * @property $libelle
 * @property $created_at
 * @property $updated_at
 *
 * @property Chambre[] $chambres
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Type extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['libelle'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chambres()
    {
        return $this->hasMany(\App\Models\Chambre::class, 'id', 'type_id');
    }
    
}
