<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\User\UserResource;
use App\Models\Haircuts\Haircut;
use App\Models\User;
use App\Models\Users\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends ApiController
{
    /**
     * construct instanciate the model class and the fillable fields of the user model
     */
    public function __construct()
    {
        $this->model = new User();
        parent::__construct();
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        // validate the request
        $request->validate([
            'first_name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        // fill the user model with the request data
        $fields = collect($request->all());
        // Set data to the model
        $userModel = $this->fillModel($this->model, $fields);
        $userModel->name = $request->first_name . ' ' . $request->last_name;
        $userModel->password = bcrypt($request->password);
        // Save the model
        $success = $userModel->save();
        // Check if the model has been saved
        if (!$success) {
            return $this->return500("Une erreur est survenue lors de l'inscription de l'utilisateur");
        }
        // Add the user to the default role
//        $userModel->assignRole(Role::CLIENT);
        // send email verification
        $userModel->sendPasswordResetNotification(Str::random(60));
        $userModel->sendEmailVerificationNotification();
        return $this->sendResponse('Un mail de confirmation vous a été envoyé', 201);
    }

    /**
     * @description login the user
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
            return $this->return401("L'adresse email ou le mot de passe est incorrect");
        }

        $user = $request->user();

        // check if user is verified
        if (!$user->hasVerifiedEmail()) {
            return response()->json(
                [
                    'message' => 'Veuillez confirmer votre adresse email avant de vous connecter',
                    'has_verified_email' => false,
                ], 401);
        }
        Auth::login($user, true);
        // create a token for the user
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        $haircutReservations = Haircut::getHaircutsWithReservationsFromUser($user->id);

        // return the user and the token
        return response()->json([
            'user' => UserResource::make($user),
            'token' => $token,
            'token_type' => 'Bearer',
            'HaircutCart' => $haircutReservations,
        ], 200);
    }

    /**
     * @description logout the user
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie !'
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
            return $this->return404("Utilisateur introuvable");
        }

        $user->sendPasswordResetNotification(Str::random(60));

        return response()->json([
            'message' => "Le lien de réinitialisation du mot de passe a bien été envoyé à l'adresse email"
        ], 200);
    }

    /**
     *  Reset password
     * @param Request $request
     * @return JsonResponse
     */
    public function resetPassword(Request $request): JsonResponse
    {
        // validate the request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed|min:8',
        ]);
        // check if reset password token is valid or not expired
        if (PasswordReset::checkIsValidToken($request->email, $request->token) !== true) {
            return response()->json([
                'message' => 'Token invalide ou expiré'
            ], 401);
        }
        //chef valide email
        $userModel = User::query()->where('email', $request->email)->first();
        // check if the user exists
        if (!$userModel) {
            return $this->return404("Utilisateur introuvable");
        }
        // send email verification
        $userModel->password = bcrypt($request->password);
        $userModel->save();

        return $this->sendResponse('Le mot de passe a bien été réinitialisé', 201);
    }


    /**
     *  Get url to confirm email
     * @param Request $request
     * @return JsonResponse
     */
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

    // set session for user logged in
    public function setSession(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);
        $user = User::query()->where('id', $request->user_id)->first();
        if (!$user) {
            return $this->return404("Utilisateur introuvable");
        }
        Auth::login($user, true);
        return $this->sendResponse('Session mise à jour', 200);
    }
}
