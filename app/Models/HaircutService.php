<?php

namespace App\Models;

use App\Models\Haircut\HaircutReservation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class HaircutService extends Model
{
    use HasFactory;

    public function price(): Attribute {
        return Attribute::make(
            fn($value) => Str::replace('.', ',', $value) . '€'
        );
    }

    protected $table = 'haircut_services';

    protected $fillable = [
        'haircut_service_name',
        'haircut_service_price',
        'haircut_service_duration',
        'haircut_service_description',
        'haircut_service_image',
        'haircut_reservation_times',
    ];

    protected $casts = [
        'haircut_service_price' => 'float',
        'haircut_reservation_times' => 'array',
    ];

    public function haircutReservation(): HasMany
    {
        return $this->hasMany(HaircutReservation::class);
    }

    public function scopeHaircutReservationTimes(Builder $query, $haircutReservationTimes)
    {
        return $query->where('haircut_reservation_times', $haircutReservationTimes);
    }

    //---------------------------------------- SCOPES ----------------------------------------

    // scope for beard service find by category
    public function scopeHaircutServiceCategory(Builder $query, $haircutServiceCategory)
    {
        return $query->where('haircut_service_category', $haircutServiceCategory);
    }

}
