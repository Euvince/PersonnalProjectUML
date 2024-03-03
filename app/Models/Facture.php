<?php

namespace App\Models;

use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'nom_client',
        'paiement_id',
        'email_client',
        'montant_total',
        'prenoms_client',
        'telephone_client',
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole() && auth()->check()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($facture) use ($userFullName) {
                $facture->created_by = $userFullName;
            });

            static::updating(function ($facture) use ($userFullName) {
                $facture->updated_by = $userFullName;
            });

            static::deleting(function ($facture) use ($userFullName) {
                $facture->deleted_by = $userFullName;
                $facture->save();
            });
        }
    }

    public function paiement() : BelongsTo {
        return $this->belongsTo(Paiement::class);
    }

}
