<?php

namespace Database\Factories;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Listing::class;
    public function definition(): array
    {
        return [
            'beds' => $this->faker->numberBetween(1, 9),
            'baths' => $this->faker->numberBetween(1, 9),
            'area' => $this->faker->numberBetween(30, 400),
            'city' => $this->faker->city(),
            'code' => $this->faker->postcode(),
            'street' => $this->faker->streetName(),
            'street_no' => $this->faker->numberBetween(1, 9),
            'price' => $this->faker->numberBetween(50_000, 200_000),
        ];
    }
}
