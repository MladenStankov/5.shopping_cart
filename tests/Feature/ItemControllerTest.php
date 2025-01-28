<?php

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list all items for a cart', function () {
    $cart = Cart::factory()->create();
    Item::factory()->count(3)->create(['cart_id' => $cart->id]);

    $response = $this->getJson("/api/carts/{$cart->id}/items");

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('can create an item for a cart', function () {
    $cart = Cart::factory()->create();
    $itemData = ['name' => 'Test Item', 'price' => 100];

    $response = $this->postJson("/api/carts/{$cart->id}/items", $itemData);

    $response->assertStatus(201)
        ->assertJson($itemData);
});

it('can show an item', function () {
    $cart = Cart::factory()->create();
    $item = Item::factory()->create(['cart_id' => $cart->id]);

    $response = $this->getJson("/api/carts/{$cart->id}/items/{$item->id}");

    $response->assertStatus(200)
        ->assertJson($item->toArray());
});

it('can update an item', function () {
    $cart = Cart::factory()->create();
    $item = Item::factory()->create(['cart_id' => $cart->id]);
    $updatedData = ['name' => 'Updated Item', 'price' => 200];

    $response = $this->putJson("/api/carts/{$cart->id}/items/{$item->id}", $updatedData);

    $response->assertStatus(200)
        ->assertJson($updatedData);
});

it('can delete an item', function () {
    $cart = Cart::factory()->create();
    $item = Item::factory()->create(['cart_id' => $cart->id]);

    $response = $this->deleteJson("/api/carts/{$cart->id}/items/{$item->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('items', ['id' => $item->id]);
});
