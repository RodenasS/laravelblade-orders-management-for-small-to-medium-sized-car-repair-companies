<?php

namespace Database\Factories;

use App\Models\Client;
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
            'client_id' => Client::factory(), // Assuming this needs to be associated separately
            'brand' => $this->faker->randomElement(['Toyota', 'Ford', 'Honda', 'BMW', 'Audi']),
            'model' => $this->faker->word,
            'mileage' => $this->faker->numberBetween(1000, 200000),
            'first_registration' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            'license_plate' => $this->faker->regexify('[A-Z]{2}[0-9]{4}'),
            'vin' => $this->faker->bothify('??######?????????'), // Generates a random VIN-like string
            'description' => $this->faker->text(),
        ];
    }
}
