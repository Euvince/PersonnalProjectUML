<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chambre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'prix',
        'statut',
        'user_id',
        'chambre_id',
        'fin_sejour',
        'debut_sejour',
        'prix_par_nuit',
        'date_reservation',
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole() && auth()->check()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($reservation) use ($userFullName) {
                $reservation->created_by = $userFullName;
            });

            static::updating(function ($reservation) use ($userFullName) {
                $reservation->updated_by = $userFullName;
            });

            static::deleting(function ($reservation) use ($userFullName) {
                $reservation->deleted_by = $userFullName;
                $reservation->save();
            });
        }
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function chambre() : BelongsTo {
        return $this->belongsTo(Chambre::class);
    }

}
