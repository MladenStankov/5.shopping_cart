<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Cart;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cart $cart)
    {
        return response()->json($cart->items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Cart $cart, ItemRequest $request)
    {
        $item = $cart->items()->create($request->validated());

        return response()->json($item, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart, Item $item)
    {
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Cart $cart, ItemRequest $request, Item $item)
    {
        $item->update($request->validated());

        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart, Item $item)
    {
        $item->delete();

        return response()->json(null, 204);
    }
}
