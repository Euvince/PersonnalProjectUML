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

    protected $guarded = [];

    /* protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($role) use ($userFullName) {
                $role->created_by = $userFullName;
            });

            static::updating(function ($role) use ($userFullName) {
                $role->updated_by = $userFullName;
            });

            static::deleting(function ($role) use ($userFullName) {
                $role->deleted_by = $userFullName;
                $role->save();
            });
        }
    } */

    public function TypeRole() : BelongsTo {
        return $this->belongsTo(TypeRole::class, 'type_role_id', 'id');
    }

}
