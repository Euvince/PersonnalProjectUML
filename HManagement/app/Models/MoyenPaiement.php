<?php

namespace App\Models;

use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MoyenPaiement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'moyens_paiements';

    protected $fillable = [
        'id', 'moyen'
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($moyenPaiement) use ($userFullName) {
                $moyenPaiement->created_by = $userFullName;
            });

            static::updating(function ($moyenPaiement) use ($userFullName) {
                $moyenPaiement->updated_by = $userFullName;
            });

            static::deleting(function ($moyenPaiement) use ($userFullName) {
                $moyenPaiement->deleted_by = $userFullName;
                $moyenPaiement->save();
            });
        }
    }

    public function paiements() : HasMany {
        return $this->hasMany(Paiement::class, 'moyen_paiment_id', 'id');
    }

}
