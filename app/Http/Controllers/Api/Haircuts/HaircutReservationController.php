<?php

namespace App\Http\Controllers\Api\Haircuts;

use App\Http\Controllers\Api\ApiController;
use App\Models\HairCuts\HaircutReservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class HaircutReservationController extends ApiController
{

    /**
     * construct instanciate the model class and the fillable fields of the user model
     */
    public function __construct()
    {
        $this->model = new HaircutReservation();
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
    public function store(Request $request): JsonResponse
    {
        $fields = collect($request->all());
        // Set data to the model
        $haircutReservation = $this->fillModel(new HaircutReservation(), $fields);
        // Save the model
        $success = $haircutReservation->save();
        // Check if the model has been saved
        if (!$success) {
            return $this->return500();
        }
        // Return the response
        return response()->json(
            [
                'user_id' => $haircutReservation->getKey(),
                'success' => true,
                'message' => ''
            ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HairCuts\HaircutReservation  $haircutReservation
     * @return \Illuminate\Http\Response
     */
    public function show(HaircutReservation $haircutReservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\HairCuts\HaircutReservation  $haircutReservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HaircutReservation $haircutReservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HairCuts\HaircutReservation  $haircutReservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(HaircutReservation $haircutReservation)
    {
        //
    }

    /**
     * @description get the unavailable hours for a haircut service by date ( hours already booked )
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function getHaircutReservationTimesByDate(Request $request, $id): JsonResponse
    {
        $haircutReservationTimes = HaircutReservation::query()->where('haircut_id', $id)
            ->where('start_date', $request->start_date)
            ->get(['start_time']);

        return response()->json($haircutReservationTimes);
    }
}
