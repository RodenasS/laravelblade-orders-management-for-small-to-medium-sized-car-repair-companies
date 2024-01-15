<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition() {
        $year = now()->year;
        $estimated_start = $this->faker->dateTimeBetween("$year-01-01", "$year-12-31");

        $estimated_end = $this->faker->dateTimeBetween($estimated_start, $estimated_start->format('Y-m-d') . ' +2 days');

        return [
            'order_number' => 'U' . time() . $this->faker->unique()->randomNumber(3),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['vykdomas', 'įvykdytas', 'atšauktas']),
            'estimated_start' => $estimated_start,
            'estimated_end' => $estimated_end,
            'client_id' => \App\Models\Client::factory(),
            'vehicle_id' => \App\Models\Vehicle::factory(),
            'user_id' => User::factory(),
            'vehicle_mileage' => $this->faker->numberBetween(1000, 200000),
            'total_ex_vat' => $this->faker->randomFloat(2, 100, 10000),
            'vat' => $this->faker->randomFloat(2, 5, 25),
            'total_inc_vat' => function (array $attributes) {
                return $attributes['total_ex_vat'] + ($attributes['total_ex_vat'] * ($attributes['vat'] / 100));
            },
            'description' => $this->faker->text(200),
        ];
    }
}
