<?php

namespace App\Models;

use App\Models\TypeRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as ModelsRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends ModelsRole
{
    use HasFactory, SoftDeletes;

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($chambre) use ($userFullName) {
                $chambre->created_by = $userFullName;
            });

            static::updating(function ($chambre) use ($userFullName) {
                $chambre->updated_by = $userFullName;
            });

            static::deleting(function ($chambre) use ($userFullName) {
                $chambre->deleted_by = $userFullName;
                $chambre->save();
            });
        }
    }

    public function TypeRole() : BelongsTo {
        return $this->belongsTo(TypeRole::class, 'type_role_id', 'id');
    }

}
