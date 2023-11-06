<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition() {
        // Generate a random start date
        $estimated_start = $this->faker->dateTimeBetween('-1 month', '+1 month');

        // Generate an end date that's after the start date
        $estimated_end = $this->faker->dateTimeBetween($estimated_start, '+1 month');

        return [
            'order_number' => $this->faker->unique()->numerify('Order###'),
            'date' => $this->faker->date(),
            'client_id' => \App\Models\Client::factory(),
            'vehicle_id' => \App\Models\Vehicle::factory(),
            'special_conditions' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['Priimtas', 'Vykdomas', 'Baigtas']),
            'estimated_start' => $estimated_start,
            'estimated_end' => $estimated_end,
            'total_ex_vat' => $this->faker->randomFloat(2, 100, 1000),
            'vat' => $this->faker->randomFloat(2, 20, 200),
            'total_inc_vat' => function (array $attributes) {
    return $attributes['total_ex_vat'] + $attributes['vat'];
},
        ];
    }
}
