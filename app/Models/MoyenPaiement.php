<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MoyenPaiement
 *
 * @property $id
 * @property $Designation
 * @property $Cle_privee
 * @property $Cle_public
 * @property $isActif
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Maison[] $maisons
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MoyenPaiement extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['Designation', 'Cle_privee', 'Cle_public', 'isActive', 'user_id'];


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
    public function maisons()
    {
        return $this->hasMany(\App\Models\Maison::class, 'id', 'moyenPaiement_id');
    }

}
