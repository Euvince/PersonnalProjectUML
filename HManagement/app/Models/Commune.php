<?php

namespace App\Models;

use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commune extends Model
{
    use HasFactory, SoftDeletes;

    public function departement() : BelongsTo {
        return $this->belongsTo(Departement::class);
    }

    public function arrondissements() : HasMany {
        return $this->hasMany(Arrondissement::class);
    }

}
