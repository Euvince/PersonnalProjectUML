<?php

namespace App\Models;

use App\Models\User;
use App\Models\TypeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_PAID = 'Payé';
    const STATUS_UNPAID = 'Impayé';
    const STATUS_RENDERED = 1;

    protected $fillable = [
        'prix',
        'rendu',
        'statut',
        'user_id',
        'nom_client',
        'chambre_id',
        'description',
        'email_client',
        'prenoms_client',
        'telephone_client',
        'type_service_id',
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole() && auth()->check()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($service) use ($userFullName) {
                $service->created_by = $userFullName;
            });

            static::updating(function ($service) use ($userFullName) {
                $service->updated_by = $userFullName;
            });

            static::deleting(function ($service) use ($userFullName) {
                $service->deleted_by = $userFullName;
                $service->save();
            });
        }
    }

    public function paid() : bool {
        return $this->statut === self::STATUS_PAID;
    }

    public function markAsPaid() : void {
        $this->update(['statut' => self::STATUS_PAID]);
    }

    public function isRendered() : bool {
        return $this->rendu === self::STATUS_RENDERED;
    }

    public function markAsRendered() : void {
        $this->update(['rendu' => self::STATUS_RENDERED]);
    }

    public function TypeService() : BelongsTo {
        return $this->belongsTo(TypeService::class, 'type_service_id', 'id');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function chambre() : BelongsTo {
        return $this->belongsTo(Chambre::class);
    }

}
