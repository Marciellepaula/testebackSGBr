<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Place::class;

    public function definition(): array
    {


        $name = $this->faker->company . ' ' . $this->faker->city;

        return [
            'name'  => $name,
            'slug'  => Str::slug($name),
            'city'  => $this->faker->city,
            'state' => $this->faker->stateAbbr,
        ];
    }
}
