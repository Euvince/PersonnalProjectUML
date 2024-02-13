<?php

namespace App\Models;

use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commune extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'longitude',
        'lattitude',
        'departement_id'
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($commune) use ($userFullName) {
                $commune->created_by = $userFullName;
            });

            static::updating(function ($commune) use ($userFullName) {
                $commune->updated_by = $userFullName;
            });

            static::deleting(function ($commune) use ($userFullName) {
                $commune->deleted_by = $userFullName;
                $commune->save();
            });
        }
    }

    public function departement() : BelongsTo {
        return $this->belongsTo(Departement::class);
    }

    public function arrondissements() : HasMany {
        return $this->hasMany(Arrondissement::class);
    }

}
