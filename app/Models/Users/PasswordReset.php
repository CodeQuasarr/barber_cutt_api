<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_resets';

    const UPDATED_AT = null;

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];


    /**
     * Check if the token is expired or not.
     * @param string $email
     * @param string $token
     * @return bool
     */
    public static function checkIsValidToken(string $email, string $token): bool
    {
        $check = self::query()->where('email', $email)->where('token', $token)->first();
        return $check !== null;
    }
}
