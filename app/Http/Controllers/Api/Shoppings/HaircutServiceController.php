<?php

namespace App\Http\Controllers\Api\Shoppings;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shopping\HaircutServiceCollection;
use App\Http\Resources\Shopping\HaircutServiceResource;
use App\Models\Category;
use App\Models\HairCutService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HaircutServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $hairStyles = HairCutService::query()->where('category_id', Category::HAIRECUT)->get();
        $beardStyles = HairCutService::query()->where('category_id', Category::BEARD)->get();
        $massageStyles = HairCutService::query()->where('category_id', Category::MASSAGE)->get();

        return HaircutServiceCollection::collection([
            'hairs' => $hairStyles,
            'beards' => $beardStyles,
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
     * @param  \App\Models\HairCutService  $hairCutService
     * @return \Illuminate\Http\Response
     */
    public function show(HairCutService $hairCutService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HairCutService  $hairCutService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HairCutService $hairCutService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HairCutService  $hairCutService
     * @return \Illuminate\Http\Response
     */
    public function destroy(HairCutService $hairCutService)
    {
        //
    }
}
