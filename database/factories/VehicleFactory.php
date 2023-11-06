<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition()
    {
        return [
            'client_id' => \App\Models\Client::factory(),
            'brand' => $this->faker->randomElement(['Toyota', 'Ford', 'Honda', 'BMW', 'Audi']),
            'model' => $this->faker->word,
            'mileage' => $this->faker->numberBetween(10000, 200000),
            'first_registration' => $this->faker->date('Y-m-d', 'now'),
            'license_plate' => $this->faker->regexify('[A-Z]{3} [0-9]{3}'),
            'vin' => $this->faker->regexify('[A-HJ-NPR-Z0-9]{17}')
        ];
    }
}
