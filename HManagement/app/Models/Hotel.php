<?php

namespace App\Models;

use App\Models\User;
use App\Models\Commune;
use App\Models\Quartier;
use App\Models\Departement;
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
        'longitude',
        'lattitude',
        'telephone',
        'directeur',
        'quartier_id',
        'adresse_postale',
    ];

    /* protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($hotel) use ($userFullName) {
                $hotel->created_by = $userFullName;
            });

            static::updating(function ($hotel) use ($userFullName) {
                $hotel->updated_by = $userFullName;
            });

            static::deleting(function ($hotel) use ($userFullName) {
                $hotel->deleted_by = $userFullName;
                $hotel->save();
            });
        }
    } */

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
        return $this->hasMany(User::class);
    }

    public function users() : HasMany {
        return $this->hasMany(User::class);
    }

    /* public function users() : BelongsToMany {
        return $this->belongsToMany(User::class);
    } */

}
