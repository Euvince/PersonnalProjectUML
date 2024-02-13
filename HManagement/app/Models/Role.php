<?php

namespace App\Models;

use App\Models\TypeRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as ModelsRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends ModelsRole
{
    use HasFactory, SoftDeletes;

    public function TypeRole() : BelongsTo {
        return $this->belongsTo(TypeRole::class, 'type_role_id', 'id');
    }

}
