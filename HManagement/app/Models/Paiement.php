<?php

namespace App\Models;

use App\Models\Facture;
use App\Models\MoyenPaiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'montant',
        'user_id',
        'date_paiement',
        'moyen_paiement_id'
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($paiement) use ($userFullName) {
                $paiement->created_by = $userFullName;
            });

            static::updating(function ($paiement) use ($userFullName) {
                $paiement->updated_by = $userFullName;
            });

            static::deleting(function ($paiement) use ($userFullName) {
                $paiement->deleted_by = $userFullName;
                $paiement->save();
            });
        }
    }

    public function MoyenPaiement() : BelongsTo {
        return $this->belongsTo(MoyenPaiement::class, 'moyen_paiment_id', 'id');
    }

    public function factures() : HasMany {
        return $this->hasMany(Facture::class);
    }

}
