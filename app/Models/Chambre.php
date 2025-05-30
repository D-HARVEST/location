<?php
namespace App\Models;

use App\Models\Category;
use App\Models\LouerChambre;
use App\Models\Maison;
use App\Models\Photo;
use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Chambre
 *
 * @property int $id
 * @property string $libelle
 * @property string $statut
 * @property string $jourPaiement
 * @property float $loyer
 * @property int $categorie_id
 * @property int $type_id
 * @property int $maison_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property Category $category
 * @property Maison $maison
 * @property Type $type
 * @property LouerChambre[] $louerChambres
 * @property Photo[] $photos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Chambre extends Model
{
    protected $perPage = 20;

    protected $fillable = ['ref', 'libelle', 'statut', 'jourPaiementLoyer', 'loyer', 'categorie_id', 'type_id', 'maison_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id', 'id');
    }

    public function maison()
    {
        return $this->belongsTo(Maison::class, 'maison_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function louerChambres()
    {
        return $this->hasMany(LouerChambre::class, 'chambre_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'chambre_id', 'id');
    }

    public function historiquePaiements()
    {
        return $this->hasManyThrough(
            HistoriquePaiement::class,
            LouerChambre::class,
            'chambre_id',            // Foreign key sur `louer_chambres`
            'louerchambre_id',       // Foreign key sur `historique_paiements`
            'id',                    // Local key sur `chambres`
            'id'                     // Local key sur `louer_chambres`
        );
    }

    protected static function booted()
    {
        static::creating(function ($chambre) {
            $chambre->ref = self::generateUniqueRef();
        });
    }

    private static function generateUniqueRef()
    {
        do {
            // Génère une chaîne de 12 lettres majuscules
          $ref = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ', 12)), 0, 12);
        } while (self::where('ref', $ref)->exists());

        return $ref;
    }
}
