<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Chambre;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_PAID = 'Payé';
    const STATUS_UNPAID = 'Impayé';
    const STATUS_WITHDRAW = 1;
    const STATUS_CONFIRM = 1;

    protected $fillable = [
        'prix',
        'statut',
        'user_id',
        'retire',
        'confirme',
        'chambre_id',
        'nom_client',
        'fin_sejour',
        'debut_sejour',
        'email_client',
        'prix_par_nuit',
        'prenoms_client',
        'telephone_client',
        'date_reservation',
    ];

    protected $casts = [
        'debut_sejour' => 'datetime',
        'fin_sejour' => 'datetime',
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

    public function getMontant () : float {
        $period = Carbon::parse($this->fin_sejour)->diffInDays(Carbon::parse($this->debut_sejour));
        return $this->prix_par_nuit * $period;
    }

    public function paid() : bool {
        return $this->statut === self::STATUS_PAID;
    }

    public function markAsPaid() : void {
        $this->update(['statut' => self::STATUS_PAID]);
    }

    public function isWithdrawed() : bool {
        return $this->retire === self::STATUS_WITHDRAW;
    }

    public function markAsWithdrawed() : void {
        $this->update(['retire' => self::STATUS_WITHDRAW]);
    }

    public function isConfirmed() : bool {
        return $this->confirme === self::STATUS_CONFIRM;
    }

    public function markAsConfirmed() : void {
        $this->update(['confirme' => self::STATUS_CONFIRM]);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function chambre() : BelongsTo {
        return $this->belongsTo(Chambre::class);
    }

    public function paiement() : HasOne {
        return $this->hasOne(Paiement::class, 'reservation_id', 'id');
    }

}
