<?php

use App\Models\Cart;
use App\Models\Item;
use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list all coupons for an item', function () {
    $cart = Cart::factory()->create();
    $item = Item::factory()->create(['cart_id' => $cart->id]);
    Coupon::factory()->count(3)->create(['item_id' => $item->id]);

    $response = $this->getJson("/api/carts/{$cart->id}/items/{$item->id}/coupons");

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('can create a coupon for an item', function () {
    $cart = Cart::factory()->create();
    $item = Item::factory()->create(['cart_id' => $cart->id]);
    $couponData = ['code' => 'TEST123', 'discount' => 10];

    $response = $this->postJson("/api/carts/{$cart->id}/items/{$item->id}/coupons", $couponData);

    $response->assertStatus(201)
        ->assertJson($couponData);
});

it('can show a coupon', function () {
    $cart = Cart::factory()->create();
    $item = Item::factory()->create(['cart_id' => $cart->id]);
    $coupon = Coupon::factory()->create(['item_id' => $item->id]);

    $response = $this->getJson("/api/carts/{$cart->id}/items/{$item->id}/coupons/{$coupon->id}");

    $response->assertStatus(200)
        ->assertJson($coupon->toArray());
});

it('can update a coupon', function () {
    $cart = Cart::factory()->create();
    $item = Item::factory()->create(['cart_id' => $cart->id]);
    $coupon = Coupon::factory()->create(['item_id' => $item->id]);
    $updatedData = ['code' => 'UPDATED123', 'discount' => 20];

    $response = $this->putJson("/api/carts/{$cart->id}/items/{$item->id}/coupons/{$coupon->id}", $updatedData);

    $response->assertStatus(200)
        ->assertJson($updatedData);
});

it('can delete a coupon', function () {
    $cart = Cart::factory()->create();
    $item = Item::factory()->create(['cart_id' => $cart->id]);
    $coupon = Coupon::factory()->create(['item_id' => $item->id]);

    $response = $this->deleteJson("/api/carts/{$cart->id}/items/{$item->id}/coupons/{$coupon->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('coupons', ['id' => $coupon->id]);
});
