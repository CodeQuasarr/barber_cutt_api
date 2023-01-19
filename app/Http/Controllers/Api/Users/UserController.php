<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends ApiController
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // Check if the user has the right permissions and is connected
//        if (!$request->user() || !($request->user()->isSuperAdministrator() || $request->user()->isManager())) {
//            return $this->return401();
//        }
        // Check if the request is valid
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required',
            'sexe' => 'required|boolean',
            'nationality' => 'required|string|min:3|max:3',
        ]);
        // fill the model with the request data
        $fields = collect($request->only($this->fillableFields))->filter(function ($value, $key) { return $value !== null; });
        // Set data to the model
        $userModel = $this->addDatasToModel($this->model, $fields);
        $userModel->name = $request->first_name . ' ' . $request->last_name;
        $userModel->password = bcrypt(Str::random(8));
        $userModel->email_verified_at = now();
        // Save the model
        $success = $userModel->save();
        // Check if the model has been saved
        if (!$success) {
            return $this->return500();
        }
        // Add the user to the default role
        $userModel->assignRole( $request->get('role') ?? Role::HAIRDRESSER );
        // Send mail to the user with the password and the link to the login page
        $userModel->sendPasswordResetNotification( Str::random(60) );
        // Return the response
        return response()->json(
            [
                'user_id' => $userModel->getKey(),
                'success' => true,
                'message' => 'Un mail de confirmation a été envoyer'
            ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request, User $user)
    {
        // fill the model with the request data
        $fields = collect($request->only($this->fillableFields))->filter(function ($value, $key) { return $value !== null; });
        // Set data to the model
        $userModel = $this->addDatasToModel($user, $fields);
        $userModel->name = $request->first_name . ' ' . $request->last_name;
        // Save the model
        $success = $userModel->save();
        // Check if the model has been saved
        if (!$success) {
            return $this->return500("Error while saving the user");
        }
        // sync roles
        if ($request->get('role')) {
            $userModel->syncRoles($request->get('role'));
        }
        return response()->json([
            'success' => true,
            'message' => "L'utilisateur mis à jour avec success"
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
