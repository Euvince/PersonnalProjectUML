<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\Arrondissement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quartier extends Model
{
    use HasFactory, SoftDeletes;

    public function arrondissement() : BelongsTo {
        return $this->belongsTo(Arrondissement::class);
    }

    public function hotels() : HasMany {
        return $this->hasMany(Hotel::class);
    }

}
