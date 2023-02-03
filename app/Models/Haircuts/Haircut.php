<?php

namespace App\Models\Haircuts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Haircut extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'price', 'duration', 'description', 'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    // relation with the haircut_reservation table and user table
    public function reservations()
    {
        return $this->hasMany(HaircutReservation::class)->select(['id', 'haircut_id', 'start_date', 'start_time', 'status']);
    }

    // from a user's id, get the list of haircuts on which the user has made a reservation
    public static function getHaircutsWithReservationsFromUser($user_id, $haircut_id = null): array|Collection
    {
        return self::query()->with('reservations')->whereHas('reservations', function ($query) use ($user_id) {
        })->get(['id', 'name', 'price', 'description']);
    }


}
