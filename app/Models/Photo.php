<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Photo
 *
 * @property $id
 * @property $chambre_id
 * @property $url
 * @property $created_at
 * @property $updated_at
 *
 * @property Chambre $chambre
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Photo extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['chambre_id', 'url'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chambre()
    {
        return $this->belongsTo(\App\Models\Chambre::class, 'chambre_id', 'id');
    }
    
}
