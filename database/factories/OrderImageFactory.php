<?php

namespace Database\Factories;

use App\Models\OrderImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderImageFactory extends Factory
{
    protected $model = OrderImage::class;

    public function definition()
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'path' => 'images/' . Str::random(10) . '.jpg',
        ];
    }
}
