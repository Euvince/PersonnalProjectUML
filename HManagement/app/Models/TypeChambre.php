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

            static::creating(function ($user) use ($userFullName) {
                $user->created_by = $userFullName;
            });

            static::updating(function ($user) use ($userFullName) {
                $user->updated_by = $userFullName;
            });

            static::deleting(function ($user) use ($userFullName) {
                $user->deleted_by = $userFullName;
                $user->save();
            });
        }
    }

    public function chambres() : HasMany {
        return $this->hasMany(Chambre::class, 'type_chambre_id', 'id');
    }

}
