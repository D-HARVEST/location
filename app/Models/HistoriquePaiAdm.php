<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriquePaiAdm extends Model
{
    protected $table = 'historique_paiadm';

    protected $fillable = [
        'user_id',
        'modePaiement',
        'montant',
        'idTransaction',
        'datePaiement',
        'moisPaiement',
        'quittanceUrl'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


