<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\Arrondissement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quartier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'longitude',
        'lattitude',
        'arrondissement_id'
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($quartier) use ($userFullName) {
                $quartier->created_by = $userFullName;
            });

            static::updating(function ($quartier) use ($userFullName) {
                $quartier->updated_by = $userFullName;
            });

            static::deleting(function ($quartier) use ($userFullName) {
                $quartier->deleted_by = $userFullName;
                $quartier->save();
            });
        }
    }

    public function arrondissement() : BelongsTo {
        return $this->belongsTo(Arrondissement::class);
    }

    public function hotels() : HasMany {
        return $this->hasMany(Hotel::class);
    }

}
