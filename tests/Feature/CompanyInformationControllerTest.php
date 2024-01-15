<?php

namespace Tests\Feature;

use App\Models\CompanyInformation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CompanyInformationControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function authenticateAsAdmin()
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        return $admin;
    }

    public function test_admin_can_view_company_information_edit_form()
    {
        $this->authenticateAsAdmin();
        $companyInformation = CompanyInformation::first();
        $response = $this->get("/company_information/{$companyInformation->id}/edit");
        $response->assertStatus(200);
    }
    public function test_admin_can_update_company_information()
    {
        $admin = $this->authenticateAsAdmin();

        $companyInformation = CompanyInformation::first();

        $updatedData = [
            'name' => 'Automistro',
            'company_code' => '123123123123',
            'company_vat_code' => 'LT123123123123',
            'address' => 'Adreso g. 7, Klaipėda',
            'phone_number' => '+37060000000',
            'email' => 'info@automistro.lt',
            'invoice_account' => 'LT123123123123',
            'invoice_account_bank' => 'Bankas',
        ];

        $response = $this->put("/company_information/{$companyInformation->id}", $updatedData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('company_information', $updatedData);
    }

    public function test_admin_can_update_company_logo()
    {
        $admin = $this->authenticateAsAdmin();

        $companyInformation = CompanyInformation::first();

        // Upload a sample logo for testing
        Storage::fake('public');
        $logoPath = UploadedFile::fake()->image('logo.jpg')->store('logos', 'public');

        $updatedData = [
            'logo' => $logoPath,
        ];

        $response = $this->put("/company_information/{$companyInformation->id}", $updatedData);
        $response->assertStatus(302);

        Storage::disk('public')->assertExists($logoPath);
    }

    public function test_admin_cannot_create_company_information()
    {
        $admin = $this->authenticateAsAdmin();
        $companyInformation = CompanyInformation::first();
        $newCompanyData = [
            'name' => 'New Company',
            'company_code' => 'ABC123',
            'company_vat_code' => 'VAT456',
            'address' => '123 Main St',
            'phone_number' => '123-456-7890',
            'email' => 'new@example.com',
            'invoice_account' => 'Invoice123',
            'invoice_account_bank' => 'Bank456',
        ];

        $response = $this->post("/company_information/{$companyInformation->id}", $newCompanyData);
        $response->assertStatus(405);
    }

    public function test_admin_cannot_delete_company_information()
    {
        $admin = $this->authenticateAsAdmin();

        $companyInformation = CompanyInformation::first();
        $response = $this->delete("/company_information/{$companyInformation->id}");
        $response->assertStatus(405);
    }

    public function test_admin_can_delete_company_logo()
    {
        $admin = $this->authenticateAsAdmin();
        $companyInformation = CompanyInformation::first();
        $response = $this->delete(route('company_information.delete_logo', ['companyInformation' => $companyInformation]));
        $response->assertStatus(302);
        $companyInformation->refresh();
        $this->assertNull($companyInformation->logo_path);

        Storage::disk('public')->assertMissing($companyInformation->getOriginal('logo_path'));
    }

}
