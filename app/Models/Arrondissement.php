<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\Commune;
use App\Models\Quartier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arrondissement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'longitude',
        'lattitude',
        'commune_id'
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole() && auth()->check()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($arrondissement) use ($userFullName) {
                $arrondissement->created_by = $userFullName;
            });

            static::updating(function ($arrondissement) use ($userFullName) {
                $arrondissement->updated_by = $userFullName;
            });

            static::deleting(function ($arrondissement) use ($userFullName) {
                $arrondissement->quartiers->each(function ($quartier) {
                    $quartier->delete();
                });
                $arrondissement->deleted_by = $userFullName;
                $arrondissement->save();
            });
        }
    }

    public function commune() : BelongsTo {
        return $this->belongsTo(Commune::class);
    }

    public function quartiers() : HasMany {
        return $this->hasMany(Quartier::class);
    }

    public function hotels() : HasMany {
        return $this->hasMany(Hotel::class);
    }

}
