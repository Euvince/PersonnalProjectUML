<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\TypeChambre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chambre extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'etage',
        'statut',
        'numero',
        'capacite',
        'libelle',
        'description',
        'hotel_id',
        'type_chambre_id'
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole() && auth()->check()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($chambre) use ($userFullName) {
                $chambre->created_by = $userFullName;
            });

            static::updating(function ($chambre) use ($userFullName) {
                $chambre->updated_by = $userFullName;
            });

            static::deleting(function ($chambre) use ($userFullName) {
                $chambre->deleted_by = $userFullName;
                $chambre->save();
            });
        }
    }

    public function hotel() : BelongsTo {
        return $this->belongsTo(Hotel::class);
    }

    public function TypeChambre() : BelongsTo {
        return $this->belongsTo(TypeChambre::class, 'type_chambre_id', 'id');
    }

    public function reservations() : HasMany {
        return $this->hasMany(Reservation::class);
    }

    public function services() : HasMany {
        return $this->hasMany(Service::class);
    }

}
