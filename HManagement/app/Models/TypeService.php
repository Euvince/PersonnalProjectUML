<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
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

    protected static function boot() {

        parent::boot();
        if (!app()->runningInConsole()) {
            $userFullName = Auth::user()->nom . " " . Auth::user()->prenoms;

            static::creating(function ($typeService) use ($userFullName) {
                $typeService->created_by = $userFullName;
            });

            static::updating(function ($typeService) use ($userFullName) {
                $typeService->updated_by = $userFullName;
            });

            static::deleting(function ($typeService) use ($userFullName) {
                $typeService->deleted_by = $userFullName;
                $typeService->save();
            });
        }
    }

    public function services() : HasMany {
        return $this->hasMany(Service::class, 'type_service_id', 'id');
    }
}
