<?php


use App\Models\Order;
use App\Models\OrderImage;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DetailedOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    /** @test */
    public function an_order_item_can_be_added_to_an_order()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'product_code' => 'P-01',
            'product_name' => 'Tepalai',
            'quantity' => '10',
            'unit' => 'l',
            'unit_price' => '10',
        ]);

        $this->assertInstanceOf(OrderItem::class, $orderItem);
        $this->assertEquals($order->id, $orderItem->order_id);
    }

    /** @test */
    public function an_order_item_can_be_updated()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'product_code' => 'P-01',
            'product_name' => 'Tepalai',
            'quantity' => '10',
            'unit' => 'l',
            'unit_price' => '10',
        ]);

        $updatedData = [
            'product_code' => 'P-02',
            'product_name' => 'New Product',
            'quantity' => '5',
            'unit' => 'kg',
            'unit_price' => '15',
        ];

        $orderItem->update($updatedData);

        $this->assertDatabaseHas('order_items', $updatedData);
    }

    /** @test */
    public function an_order_item_can_be_deleted()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'product_code' => 'P-01',
            'product_name' => 'Tepalai',
            'quantity' => '10',
            'unit' => 'l',
            'unit_price' => '10',
        ]);

        $orderItem->delete();

        $this->assertDatabaseMissing('order_items', ['id' => $orderItem->id]);
    }

    /** @test */
    public function an_image_can_be_added_to_an_order()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $imageData = ['path' => 'new-image.jpg'];

        $order->images()->create($imageData);

        $this->assertDatabaseHas('order_images', $imageData);
    }

    /** @test */
    public function an_image_can_be_updated()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        $image = OrderImage::create(['order_id' => $order->id, 'path' => 'old-image-path.jpg']);

        $updatedData = ['path' => 'new-image-path.jpg'];
        $image->update($updatedData);
        $this->assertDatabaseHas('order_images', $updatedData);
    }

    /** @test */
    public function an_image_can_be_deleted()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        $image = OrderImage::create(['order_id' => $order->id, 'path' => 'image-to-delete.jpg']);
        $image->delete();
        $this->assertDatabaseMissing('order_images', ['id' => $image->id]);
    }

    /** @test */
    /** @test */
    public function it_streams_generated_pdf_file()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        $response = $this->get(route('generatePDF', ['order' => $order->id]));
        if ($response->isRedirect()) {
            $response = $this->get($response->headers->get('Location'));
        }
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $this->assertNotEmpty($response->getContent());

    }

}
