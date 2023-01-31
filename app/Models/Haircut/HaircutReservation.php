<?php

namespace App\Models\Haircut;

use App\Models\HaircutService;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HaircutReservation extends Model
{
    use HasFactory, SoftDeletes;

    const RESERVATION_AT_11 = "11:00";
    const RESERVATION_AT_11_30 = "11:30";
    const RESERVATION_AT_12 = "12:00";
    const RESERVATION_AT_12_30 = "12:30";
    const RESERVATION_AT_13 = "13:00";
    const RESERVATION_AT_15 = "15:00";
    const RESERVATION_AT_15_30 = "15:30";
    const RESERVATION_AT_16 = "16:00";
    const RESERVATION_AT_16_30 = "16:30";
    const RESERVATION_AT_17 = "17:00";
    const RESERVATION_AT_17_30 = "17:30";
    const RESERVATION_AT_18 = "18:00";
    const RESERVATION_AT_18_30 = "18:30";

    protected $table = 'haircut_reservations';

    protected $fillable = [
        'haircut_service_id',
        'user_id',
        'haircut_reservation_time',
        'haircut_reservation_start_date',
        'haircut_reservation_status',
    ];

    protected $casts = [
        'haircut_reservation_start_date' => 'date',
        'haircut_reservation_status' => 'boolean',
    ];

    public function haircutService()
    {
        return $this->belongsTo(HaircutService::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //---------------------------------------- SCOPES ----------------------------------------

    public function scopeReservationAt11(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_11);
    }

    public function scopeReservationAt11_30(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_11_30);
    }

    public function scopeReservationAt12(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_12);
    }

    public function scopeReservationAt12_30(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_12_30);
    }

    public function scopeReservationAt13(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_13);
    }

    public function scopeReservationAt15(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_15);
    }

    public function scopeReservationAt15_30($query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_15_30);
    }

    public function scopeReservationAt16(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_16);
    }

    public function scopeReservationAt16_30(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_16_30);
    }

    public function scopeReservationAt17(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_17);
    }

    public function scopeReservationAt17_30($query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_17_30);
    }

    public function scopeReservationAt18(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_18);
    }

    public function scopeReservationAt18_30(Builder $query)
    {
        return $query->where('haircut_reservation_time', self::RESERVATION_AT_18_30);
    }

    public function scopeReservationAt(Builder $query, $reservationTime)
    {
        return $query->where('haircut_reservation_time', $reservationTime);
    }

}
