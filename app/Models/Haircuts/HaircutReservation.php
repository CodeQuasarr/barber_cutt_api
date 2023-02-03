<?php

namespace App\Models\Haircuts;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HaircutReservation extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'haircut_id',
        'user_id',
        'start_date',
        'start_time',
        'status',
    ];

    /**
     * @description get the haircut service for the reservation
     * @return BelongsTo
     */
    public function haircut(): BelongsTo
    {
        return $this->belongsTo(Haircut::class);
    }

    /**
     * @description get the user for the reservation
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
