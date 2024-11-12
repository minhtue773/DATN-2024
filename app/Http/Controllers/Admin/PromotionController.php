<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promotion;
use App\Models\DiscountCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DiscountCode::query();
        if ($request->status > 0) {
            $query->where('status', $request->status);
        }
        $DiscountCodes = $query->get();
        return view('admin.promotion.promotion', compact('DiscountCodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.promotion.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromotionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
