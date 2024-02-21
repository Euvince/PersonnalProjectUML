<?php

namespace App\Models;

use App\Models\User;
use App\Models\TypeService;
use Illuminate\Support\Facades\Auth;
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
        'chambre_id',
        'description',
        'type_service_id',
    ];

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole() && auth()->check()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($service) use ($userFullName) {
                $service->created_by = $userFullName;
            });

            static::updating(function ($service) use ($userFullName) {
                $service->updated_by = $userFullName;
            });

            static::deleting(function ($service) use ($userFullName) {
                $service->deleted_by = $userFullName;
                $service->save();
            });
        }
    }

    public function TypeService() : BelongsTo {
        return $this->belongsTo(TypeService::class, 'type_service_id', 'id');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function chambre() : BelongsTo {
        return $this->belongsTo(Chambre::class);
    }

}
