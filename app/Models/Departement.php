<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\Commune;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'longitude',
        'lattitude',
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole() && auth()->check()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($departement) use ($userFullName) {
                $departement->created_by = $userFullName;
            });

            static::updating(function ($departement) use ($userFullName) {
                $departement->updated_by = $userFullName;
            });

            static::deleting(function ($departement) use ($userFullName) {
                $departement->deleted_by = $userFullName;
                $departement->save();
            });
        }
    }

    public function communes() : HasMany {
        return $this->hasMany(Commune::class);
    }

    public function hotels() : HasMany {
        return $this->hasMany(Hotel::class);
    }

}
