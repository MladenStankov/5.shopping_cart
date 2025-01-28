<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->word,
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'item_id' => Item::factory(),
        ];
    }
}
