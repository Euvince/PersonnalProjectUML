<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\TypeChambre;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chambre extends Model
{
    use HasFactory, SoftDeletes;

    /*
        const STATUS_OCCUPIED = 'Occupé';
        const STATUS_RESERVED = 'Réservé';
        const STATUS_AVAILABLE = 'Disponible';
    */

    const STATUS_OCCUPIED = 1;
    const STATUS_RESERVED = 1;
    const STATUS_AVAILABLE = 1;

    protected $fillable = [
        'etage',
        /* 'statut', */
        'photo',
        'disponible',
        'reserve',
        'occupe',
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

    public function isAvailable() : bool {
        return $this->disponible === self::STATUS_AVAILABLE;
    }

    public function markAsAvailable() : void {
        $this->update([
            'occupe' => 0,
            'disponible' => self::STATUS_AVAILABLE
        ]);
    }

    public function isReserved() : bool {
        return $this->reserve === self::STATUS_RESERVED;
    }

    public function markAsReserved() : void {
        $this->update(['reserve' => self::STATUS_RESERVED]);
    }

    public function isOccupied() : bool {
        return $this->occupe === self::STATUS_OCCUPIED;
    }

    public function markAsOccupied() : void {
        $this->update([
            'disponible' => 0,
            'occupe' => self::STATUS_OCCUPIED
        ]);
    }

    public function getSlug() : string {
        return Str::slug($this->libelle);
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
