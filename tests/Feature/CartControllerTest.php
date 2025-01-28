<?php

use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list all carts', function () {
    Cart::factory()->count(3)->create();

    $response = $this->getJson('/api/carts');

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('can create a cart', function () {
    $cartData = ['name' => 'Test Cart'];

    $response = $this->postJson('/api/carts', $cartData);

    $response->assertStatus(201)
        ->assertJson($cartData);
});

it('can show a cart', function () {
    $cart = Cart::factory()->create();

    $response = $this->getJson("/api/carts/{$cart->id}");

    $response->assertStatus(200)
        ->assertJson($cart->toArray());
});

it('can update a cart', function () {
    $cart = Cart::factory()->create();
    $updatedData = ['name' => 'Updated Cart'];

    $response = $this->putJson("/api/carts/{$cart->id}", $updatedData);

    $response->assertStatus(200)
        ->assertJson($updatedData);
});

it('can delete a cart', function () {
    $cart = Cart::factory()->create();

    $response = $this->deleteJson("/api/carts/{$cart->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('carts', ['id' => $cart->id]);
});
