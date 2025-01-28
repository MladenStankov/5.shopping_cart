<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Item;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cart $cart, Item $item)
    {
        return response()->json($item->coupons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Cart $cart, Item $item, CouponRequest $request)
    {
        $coupon = $item->coupons()->create($request->validated());

        return response()->json($coupon, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart, Item $item, Coupon $coupon)
    {
        return response()->json($coupon);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Cart $cart, Item $item, CouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());

        return response()->json($coupon);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart, Item $item, Coupon $coupon)
    {
        $coupon->delete();

        return response()->json(null, 204);
    }
}
