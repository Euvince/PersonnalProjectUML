<?php

namespace App\Models;

use App\Models\Chambre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeChambre extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'prix'
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($typeChambre) use ($userFullName) {
                $typeChambre->created_by = $userFullName;
            });

            static::updating(function ($typeChambre) use ($userFullName) {
                $typeChambre->updated_by = $userFullName;
            });

            static::deleting(function ($typeChambre) use ($userFullName) {
                $typeChambre->deleted_by = $userFullName;
                $typeChambre->save();
            });
        }
    }

    public function chambres() : HasMany {
        return $this->hasMany(Chambre::class, 'type_chambre_id', 'id');
    }

}
