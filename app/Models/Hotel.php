<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chambre;
use App\Models\Commune;
use App\Models\Quartier;
use App\Models\Departement;
use Illuminate\Support\Str;
use App\Models\Arrondissement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'email',
        'photo',
        'longitude',
        'lattitude',
        'telephone',
        'directeur',
        'commune_id',
        'quartier_id',
        'departement_id',
        'adresse_postale',
        'arrondissement_id',
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole() && auth()->check()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($hotel) use ($userFullName) {
                $hotel->created_by = $userFullName;
            });

            static::updating(function ($hotel) use ($userFullName) {
                $hotel->updated_by = $userFullName;
            });

            static::deleting(function ($hotel) use ($userFullName) {
                $hotel->chambres->each(function ($chambre) {
                    $chambre->delete();
                });
                $hotel->deleted_by = $userFullName;
                $hotel->save();
            });
        }
    }

    public function getSlug() : string {
        return Str::slug($this->nom);
    }

    public function quartier() : BelongsTo {
        return $this->belongsTo(Quartier::class);
    }

    public function arrondissement() : BelongsTo {
        return $this->belongsTo(Arrondissement::class);
    }

    public function commune() : BelongsTo {
        return $this->belongsTo(Commune::class);
    }

    public function departement() : BelongsTo {
        return $this->belongsTo(Departement::class);
    }

    public function chambres() : HasMany {
        return $this->hasMany(Chambre::class);
    }

    public function users() : HasMany {
        return $this->hasMany(User::class);
    }

    /* public function users() : BelongsToMany {
        return $this->belongsToMany(User::class);
    } */

    public function getPicture() : void
    {

    }

}
