<?php

namespace App\Models;

use App\Models\Commune;
use App\Models\Quartier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arrondissement extends Model
{
    use HasFactory, SoftDeletes;

    public function commune() : BelongsTo {
        return $this->belongsTo(Commune::class);
    }

    public function quartiers() : HasMany {
        return $this->hasMany(Quartier::class);
    }
}
