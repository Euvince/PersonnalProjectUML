<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Chambre;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_CONFIRM = 1;
    const STATUS_FINISHED = 1;
    const STATUS_WITHDRAW = 1;
    const STATUS_PAID = 'Payé';
    const STATUS_UNPAID = 'Impayé';

    protected $fillable = [
        'prix',
        'statut',
        'user_id',
        'retire',
        'termine',
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
        'date_reservation' => 'datetime',
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

    public function getServicesPrice() : float {
        $services = $this->chambre->services->where('rendu', 1);
        foreach($services as $service) {
            $services_price = $service->TypeService->prix;
        }
        return $services->count() > 0 ? $services_price : 0;
    }

    public function getTotalPriceForCheckOut() : float {
        return $this->getServicesPrice() + $this->getMontant();
    }

    public function canBeConfirmed() : bool {
        return Carbon::now()->between($this->debut_sejour, $this->fin_sejour);
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

    public function isFinished() : bool {
        return $this->termine === self::STATUS_FINISHED;
    }

    public function markAsFinished() : void {
        $this->update(['termine' => self::STATUS_FINISHED]);
        $this->chambre->markAsAvailable();
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function chambre() : BelongsTo {
        return $this->belongsTo(Chambre::class);
    }

    public function paiements() : HasMany {
        return $this->hasMany(Paiement::class, 'reservation_id', 'id');
    }

}
