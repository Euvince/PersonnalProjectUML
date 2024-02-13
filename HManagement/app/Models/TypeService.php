<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeService extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'prix'
    ];

    public function services() : HasMany {
        return $this->hasMany(Service::class, 'type_service_id', 'id');
    }
}
