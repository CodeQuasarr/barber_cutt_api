<?php

namespace App\Http\Controllers\Api\Shoppings;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shoping\ProductCollection;
use App\Http\Resources\Shopping\HaircutServiceCollection;
use App\Http\Resources\Shopping\HaircutServiceResource;
use App\Models\Category;
use App\Models\HaircutService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $hairStyles = HairCutService::query()->where('category_id', Category::HAIRECUT)->get();
        $beardStyles = HairCutService::query()->where('category_id', Category::BEARD)->get();
        $massageStyles = HairCutService::query()->where('category_id', Category::MASSAGE)->get();

        return HaircutServiceCollection::collection([
            'hairStyles' => $hairStyles,
            'beardStyles' => $beardStyles,
            'massageStyles' => $massageStyles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
