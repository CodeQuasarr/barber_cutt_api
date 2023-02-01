<?php

namespace App\Http\Controllers\Api\Haircuts;

use App\Http\Controllers\Controller;
use App\Models\HairCuts\Haircut;
use App\Models\Haircuts\HaircutCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HaircutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $beardStyles = HairCut::query()->where('haircut_category_id', HairCutCategory::BEARD)->get();
        $hairStyles = HairCut::query()->where('haircut_category_id', HairCutCategory::HAIRECUT)->get();
        $massageStyles = HairCut::query()->where('haircut_category_id', HairCutCategory::MASSAGE)->get();

        return response()->json([
            'beards' => $beardStyles,
            'hairs' => $hairStyles,
            'massages' => $massageStyles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HairCuts\Haircut  $haircut
     * @return \Illuminate\Http\Response
     */
    public function show(Haircut $haircut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HairCuts\Haircut  $haircut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Haircut $haircut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HairCuts\Haircut  $haircut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Haircut $haircut)
    {
        //
    }
}
