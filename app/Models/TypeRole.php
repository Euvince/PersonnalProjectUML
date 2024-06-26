<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'types_roles';

    protected static function boot() {

        parent::boot();

        if (!app()->runningInConsole() && auth()->check()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($typeRole) use ($userFullName) {
                $typeRole->created_by = $userFullName;
            });

            static::updating(function ($typeRole) use ($userFullName) {
                $typeRole->updated_by = $userFullName;
            });

            static::deleting(function ($typeRole) use ($userFullName) {
                $typeRole->deleted_by = $userFullName;
                $typeRole->save();
            });
        }
    }

    public function roles() : HasMany {
        return $this->hasMany(Role::class, 'type_role_id', 'id');
    }

    public function permissions() : HasMany {
        return $this->hasMany(Permission::class, 'type_role_id', 'id');
    }

}
