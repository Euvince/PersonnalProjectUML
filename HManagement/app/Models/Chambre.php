<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\TypeChambre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chambre extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'etage',
        'statut',
        'numero',
        'hotel_id',
        'capacite',
        'libbelle',
        'description',
        'type_chambre_id'
    ];

    public function hotel() : BelongsTo {
        return $this->belongsTo(Hotel::class);
    }

    public function TypeChambre() : BelongsTo {
        return $this->belongsTo(TypeChambre::class, 'type_chambre_id', 'id');
    }

}
