<?php

namespace App\Models;

use App\Models\User;
use App\Models\TypeService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'prix',
        'user_id',
        'description',
        'type_service_id',
    ];

    public function TypeService() : BelongsTo {
        return $this->belongsTo(TypeService::class, 'type_service_id', 'id');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

}
