<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeRole extends Model
{
    use HasFactory, SoftDeletes;

    public function roles() : HasMany {
        return $this->hasMany(Role::class);
    }

    public function permissions() : HasMany {
        return $this->hasMany(Permission::class, 'type_role_id', 'id');
    }

}
