<?php

namespace App\Http\Controllers\Api\Haircuts;

use App\Http\Controllers\Api\ApiController;
use App\Models\Haircut\HaircutReservation;
use App\Models\HairCutService;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
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
     * @return Response
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
        $fields = collect($request->only($this->fillableFields))->filter(function ($value, $key) { return $value !== null; });
        // Set data to the model
        $haircutReservation = $this->addDatasToModel($this->model, $fields);
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
     * @param HairCutService $hairCutService
     * @return Response
     */
    public function show(HairCutService $hairCutService)
    {
        //$haircutService = HairCutService::find($request->haircut_service_id);
        //        $haircutReservationTimes = $haircutService->haircutReservationTimes;
        //        return response()->json($haircutReservationTimes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param HairCutService $hairCutService
     * @return Response
     */
    public function update(Request $request, HairCutService $hairCutService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HairCutService $hairCutService
     * @return Response
     */
    public function destroy(HairCutService $hairCutService)
    {
        //
    }

    public function getHaircutReservationTimesFromDate(Request $request, $id)
    {
        $haircutReservationTimes = HaircutReservation::query()->where('haircut_service_id', $id)
            ->where('haircut_reservation_start_date', $request->haircut_reservation_start_date)
            ->get(['haircut_reservation_time']);

        return response()->json($haircutReservationTimes);
    }



}
