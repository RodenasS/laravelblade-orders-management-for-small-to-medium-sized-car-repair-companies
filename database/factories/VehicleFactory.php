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
        $brands = ['Toyota', 'Ford', 'Honda', 'BMW', 'Audi', 'Volkswagen', 'Mercedes-Benz', 'Nissan', 'Mitsubishi'];
        $models = ['Camry', 'Focus', 'Civic', '3 Series', 'A4', 'Golf', 'E-Class', 'Altima', 'Outlander'];
        return [
            'client_id' => Client::factory(),
            'brand' => $this->faker->randomElement($brands),
            'model' => $this->faker->randomElement($models),
            'mileage' => $this->faker->numberBetween(1000, 200000),
            'first_registration' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            'license_plate' => strtoupper($this->faker->lexify('???')) . ':' . $this->faker->numberBetween(100, 999),
            'vin' => $this->faker->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'description' => $this->faker->sentence(5),
        ];
    }
}

