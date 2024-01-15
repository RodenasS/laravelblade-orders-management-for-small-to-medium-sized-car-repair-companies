<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexMethodDisplaysClients()
    {
        Client::factory(5)->create();
        $this->authenticateAsAdmin();
        $response = $this->get(route('clients.index'));
        $response->assertStatus(200);
        $response->assertViewIs('clients.index');
    }

    public function testCreateMethodDisplaysCreateForm()
    {
        $this->authenticateAsAdmin();
        $response = $this->get(route('clients.create'));
        $response->assertStatus(200);
        $response->assertViewIs('clients.create');
    }

    public function testStoreMethodCreatesClient()
    {
        $this->authenticateAsAdmin();
        $data = [
            'name' => 'Test Client',
            'company_code' => '123456789012345',
            'company_vat_code' => '123456789',
            'email' => 'testclient@example.com',
            'phone' => '+37061234567',
            'address' => '123 Main St, City',
        ];
        $response = $this->post(route('clients.store'), $data);
        $this->assertDatabaseHas('clients', ['name' => 'Test Client']);
        $response->assertRedirect(route('clients.index'));
    }

    public function testEditMethodDisplaysEditForm()
    {
        $client = Client::factory()->create();
        $this->authenticateAsAdmin();
        $response = $this->get(route('clients.edit', $client));
        $response->assertStatus(200);
        $response->assertViewIs('clients.edit');
    }

    public function testUpdateMethodUpdatesClient()
    {
        $client = Client::factory()->create();
        $this->authenticateAsAdmin();
        $data = [
            'name' => 'Updated Client Name',
            'company_code' => '123456789012345',
            'company_vat_code' => '123456789',
            'email' => 'updatedclient@example.com',
            'phone' => '+37061234567',
            'address' => '456 Updated St, City',
        ];
        $response = $this->put(route('clients.update', $client), $data);
        $this->assertDatabaseHas('clients', ['name' => 'Updated Client Name']);
        $response->assertRedirect(route('clients.index'));
    }

    public function testDestroyMethodDeletesClient()
    {
        $client = Client::factory()->create();
        $this->authenticateAsAdmin();
        $response = $this->delete(route('clients.destroy', $client));
        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
        $response->assertRedirect(route('clients.index'));
    }

    public function getTotalClientsCount()
    {
        return Client::count();
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
