<?php

namespace App\Http\Controllers\Api\Mail;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public static function verifyEmail(Request $request, $id, $hash )
    {
        $user = User::findOrFail($id);
        if ( !hash_equals((string) $hash, sha1($user->getEmailForVerification())) ) {
            throw new AuthorizationException;
        }
        if ( $user->hasVerifiedEmail() ) {
            return redirect('http://192.168.1.13:8080/sign-in');
        }
        if ( $user->markEmailAsVerified() ) {
            event(new Verified($user));
        }
        return redirect('http://192.168.1.13:8080/sign-in');
    }
}
