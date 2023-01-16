<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
//use App\Models\Users\PasswordReset;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends ApiController
{
    public function int($user, $token = null): JsonResponse
    {
        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'sexe' => 'required|boolean',
        ]);

        $user = User::create( [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'sexe' => $request->sexe,
        ]);

        $user->assignRole( Role::CLIENT);

        // send email verification
        $user->sendEmailVerificationNotification();
        return $this->int($user);
    }


    public function confirmEmail(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::query()->where('email', $request->email)->first();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email déjà vérifié'
            ], 200);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => "Lien de vérification d'email envoyé sur votre adresse e-mail"
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        // check if user is verified
        if ( !$user->hasVerifiedEmail() ) {
            return response()->json([
                'message' => 'Please verify your email address',
                'has_verified_email' => false,
            ], 401);
        }
        $token = $user->createToken('Personal Access Token')->plainTextToken;

//        return $this->int($user, $tokenResult->accessToken);
        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     *  Get url to reset password
     * @param Request $request
     * @return JsonResponse
     */
    public function forgotPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::query()->where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email non trouvé'
            ], 200);
        }
        $token = Str::random(60);

        $user->sendPasswordResetNotification($token);

        return response()->json([
            'message' => "Lien de réinitialisation du mot de passe envoyé sur votre adresse e-mail"
        ], 200);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'token' => 'required|string',
        ]);

        // check if reset password token is valid or not expired
//        if ( PasswordReset::checkIsValidToken($request->email, $request->token) !== true ) {
//            return response()->json([
//                'message' => 'Token invalide ou expiré'
//            ], 401);
//        }

        $user = User::query()->where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email non trouvé'
            ], 401);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'message' => "Mot de passe réinitialisé avec succès"
        ], 200);
    }



    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return response()->json([
            'token' => auth()->user()->createToken('token')->plainTextToken
        ], 200);
    }
}
