<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_view_order_create_form()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/orders/create');
        $response->assertStatus(200);
    }

    public function test_user_can_create_an_order()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $client = Client::factory()->create();
        $vehicle = Vehicle::factory()->create();
        $orderData = [
            'client_id' => $client->id,
            'vehicle_id' => $vehicle->id,
            'vehicle_mileage' => $this->faker->numberBetween(1000, 200000),
            'status' => 'vykdomas',
            'estimated_start' => now()->format('Y-m-d H:i:s'),
            'estimated_end' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'items' => [
                [
                    'product_code' => 'PROD001',
                    'product_name' => 'Product 1',
                    'quantity' => 2,
                    'unit' => 'pcs',
                    'unit_price' => 10.00,
                ],
            ],
            'description' => 'Test order',
            'images' => [
                UploadedFile::fake()->image('image1.jpg'),
                UploadedFile::fake()->image('image2.jpg'),
            ],
        ];

        $response = $this->actingAs($user)->post('/orders', $orderData);

        $response->assertStatus(302);
        $response->assertRedirect('/orders');
        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseCount('order_items', 1);
        $this->assertCount(2, Order::first()->images);
        Storage::disk('public')->assertExists('images/' . $orderData['images'][0]->hashName());
    }

    public function test_user_can_view_order_edit_form()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get("/orders/{$order->id}/edit");
        $response->assertStatus(200);
    }

    public function test_user_can_update_an_order()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        $client = Client::factory()->create();
        $vehicle = Vehicle::factory()->create();

        $orderData = [
            'client_id' => $client->id,
            'vehicle_id' => $vehicle->id,
            'vehicle_mileage' => $this->faker->numberBetween(1000, 200000),
            'status' => 'įvykdytas',
            'estimated_start' => now()->format('Y-m-d H:i:s'),
            'estimated_end' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'items' => [
                [
                    'product_code' => 'PROD002',
                    'product_name' => 'Product 2',
                    'quantity' => 3,
                    'unit' => 'pcs',
                    'unit_price' => 15.00,
                ],
            ],
            'description' => 'Updated order',
            'images' => [
                UploadedFile::fake()->image('updated_image1.jpg'),
                UploadedFile::fake()->image('updated_image2.jpg'),
            ],
        ];

        $response = $this->actingAs($user)
            ->put("/orders/{$order->id}", $orderData);

        $response->assertStatus(302);
        $response->assertRedirect('/orders');

        $this->assertEquals($orderData['status'], $order->fresh()->status);
        $this->assertEquals($orderData['description'], $order->fresh()->description);
        $this->assertCount(2, $order->fresh()->images);
        Storage::disk('public')->assertExists($order->images->first()->path);

    }

    public function test_user_can_delete_an_order()
    {
        $this->authenticateAsAdmin();
        $order = Order::factory()->create();
        $response = $this->delete("/orders/{$order->id}");
        $response->assertStatus(302);
        $response->assertRedirect('/orders');
    }

    public function test_user_can_view_orders_list()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/orders');
        $response->assertStatus(200);
    }

    public function test_user_can_view_single_order()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get("/orders/{$order->id}");
        $response->assertStatus(200);
    }

    public function test_user_can_delete_order_image_in_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Storage::fake('public');
        $order = Order::factory()->create(['user_id' => $user->id]);
        $imagePath = UploadedFile::fake()->image('test.jpg')->store('images', 'public');
        $image = $order->images()->create(['path' => $imagePath]);

        $response = $this->actingAs($user)->put("/orders/{$order->id}", [
            'client_id' => $order->client_id,
            'vehicle_id' => $order->vehicle_id,
            'vehicle_mileage' => 1000,
            'status' => 'Įvykdytas',
            'estimated_start' => now(),
            'estimated_end' => now()->addDays(3),
            'items' => [
                [
                    'product_code' => 'PROD001',
                    'product_name' => 'Product 1',
                    'quantity' => 2,
                    'unit' => 'pcs',
                    'unit_price' => 10.00,
                ],
            ],
            'description' => 'Updated order',
            'removedImageIds' => implode(',', [$image->id]),
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/orders");

        Storage::disk('public')->delete($imagePath);
    }

    protected function authenticateAsAdmin()
    {
        $admin = User::factory()->create([
            'name' => 'ClientTest',
            'position' => 'ClientTest',
            'email' => 'ClientTest@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin);
    }
}
