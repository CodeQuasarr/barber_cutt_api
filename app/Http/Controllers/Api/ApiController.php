<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ApiController extends Controller
{

    protected $model;
    protected array $fillableFields;
    public function __construct()
    {
        $this->model = new User();
        $this->fillableFields = $this->model->getFillable();
    }


    /**
     * @description respond with a success or bad response
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function respondError(string $message, int $code = ResponseAlias::HTTP_OK): JsonResponse
    {
        return response()->json([
            'error' => $message,
            'code' => $code
        ], $code);
    }

    public function respondUnauthorized(): JsonResponse
    {
        return $this->respondError("Unauthorized", ResponseAlias::HTTP_UNAUTHORIZED);
    }

    /**
     * @description This function returns the data in the format that the frontend expects
     * @param $data
     * @param int $status
     * @param string|null $message
     * @param null $errors
     * @return JsonResponse
     */
    public function jsonResponse($data = null, int $status = ResponseAlias::HTTP_OK, string $message = null, $errors = null): JsonResponse
    {
        $response = [];
        if ($data !== null) {
            $response['data'] = $data;
        }
        if ($message !== null) {
            $response['message'] = $message;
        }
        if ($errors !== null) {
            $response['errors'] = $errors;
        }
        return response()->json($response, $status);
    }
    /**
     * @return JsonResponse
     */
    public function return405(): JsonResponse
    {
        return response()->json(['code' => ResponseAlias::HTTP_METHOD_NOT_ALLOWED, 'message' => 'Method Not Allowed'], ResponseAlias::HTTP_METHOD_NOT_ALLOWED);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function return500(string $message = "Serveur Error"): JsonResponse
    {
        return response()->json(['code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, 'message' => $message], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function return404(string $message = "Not Found"): JsonResponse
    {
        return response()->json(['code' => ResponseAlias::HTTP_NOT_FOUND, 'message' => $message], ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function return403(string $message = "Forbidden"): JsonResponse
    {
        return response()->json(['code' => ResponseAlias::HTTP_FORBIDDEN, 'message' => $message], ResponseAlias::HTTP_FORBIDDEN);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function return401(string $message = "Unauthorized"): JsonResponse
    {
        return response()->json(['code' => ResponseAlias::HTTP_UNAUTHORIZED, 'message' => $message], ResponseAlias::HTTP_UNAUTHORIZED);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function return503(string $message = "Service Unavailable"): JsonResponse
    {
        return response()->json(['code' => ResponseAlias::HTTP_SERVICE_UNAVAILABLE, 'message' => $message], ResponseAlias::HTTP_SERVICE_UNAVAILABLE);
    }

    /**
     * @description This function updates the model with the data sent in the request
     * @param $fields
     * @param $model
     * @return mixed
     */
    public function updateModelFields($fields, $model): mixed
    {
        $fields_list = Schema::getColumnListing($model->getTableName());
        array_walk($fields_list, function (&$field) {
            $field = strtolower($field);
        });
        foreach ($fields as $field => $value) {
            if (in_array(strtolower($field), $fields_list)) {
                $model->{$field} = $value;
            } else {
                return $this->return500("unknown field : " . $field);
            }
        }
        return $model;
    }

    protected function addDatasToModel($model, Collection $fields): mixed
    {
        foreach ($this->fillableFields as $oneKey) {
            if ($fields->has($oneKey)) $model->{$oneKey} = $fields->get($oneKey);
        }

        return $model;
    }
}
