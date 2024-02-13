<?php

namespace App\Models;

use App\Models\Paiement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'paiement_id',
        'montant_total'
    ];

    public function paiement() : BelongsTo {
        return $this->belongsTo(Paiement::class);
    }

}
