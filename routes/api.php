<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::apiResource('carts', CartController::class);
Route::apiResource('carts.items', ItemController::class);
Route::apiResource('carts.items.coupons', CouponController::class);
