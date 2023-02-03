<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Stripe\StripeClient;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ApiController
{

    protected $model;
    protected array $fillableFields;
    public function __construct()
    {
        $this->fillableFields = $this->model->getFillable();
    }

    /**
     * @param $model
     * @param Collection $fields
     * @return mixed
     */
    protected function fillModel($model, Collection $fields)
    {
        foreach ($this->fillableFields as $oneKey) {
            if ($fields->has($oneKey)) $model->{$oneKey} = $fields->get($oneKey);
        }

        return $model;
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @param  array<string, mixed>  $data
     * @return JsonResponse
     */
    public function sendResponse(string $message, int $code, array $data = []): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @param  array<string, mixed>  $data
     * @return JsonResponse
     */
    public function sendError(string $message, int $code, array $data = []): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $code);
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

    public function getCheckoutSession(Request $request) {
        $priceData = $request->get('price_data');
//        dd($line_items['product_data']);
        $stripe = new StripeClient(config('stripe.test_secret_key'));

        $checkout = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost:8080/success',
            'cancel_url' => 'http://localhost:8080/mon-panier',
            'line_items' => [
                [
                    'price_data' => $priceData,
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
        ]);

        return response()->json(["id" => $checkout->id]);
    }
}
