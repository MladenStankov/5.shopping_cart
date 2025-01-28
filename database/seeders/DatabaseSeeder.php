<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Item;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $carts = Cart::factory(3)->create();

        $carts->each(function (Cart $cart) {
            $items = Item::factory(3)->create([
                'cart_id' => $cart->id,
            ]);

            Coupon::factory()->create([
                'item_id' => $items->random(1)->first()->id,
            ]);
        });
    }
}
