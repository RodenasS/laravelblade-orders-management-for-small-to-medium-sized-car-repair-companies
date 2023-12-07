<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;

    // List of Lithuanian male first names and surnames
    private $lithuanianNames = [
        'Jonas', 'Petras', 'Antanas', 'Juozas', 'Kazimieras', 'Pranas', 'Mykolas', 'Algis', 'Darius', 'Gintaras',
        // Add more Lithuanian first names here
    ];

    private $lithuanianSurnames = [
        'Kazlauskas', 'Petrauskas', 'Sakalauskas', 'Balčiūnas', 'Jankauskas', 'Stankevičius', 'Žemaitis', 'Lukšaitis', 'Gudaitis',
        // Add more Lithuanian surnames here
    ];

    public function definition()
    {
        $name = $this->faker->randomElement($this->lithuanianNames) . ' ' . $this->faker->randomElement($this->lithuanianSurnames);

        return [
            'name' => $name,
            'company_code' => $this->faker->unique()->numerify('##############'), // Generate a unique 15-digit company code
            'company_vat_code' => $this->faker->unique()->numerify('###########'), // Generate a unique 9-digit VAT code
            'email' => strtolower($name) . '@gmail.com', // Generate email in the format name@gmail.com
            'phone' => '+370' . $this->faker->numerify('6########'), // Generate Lithuanian phone number
            'address' => $this->faker->address, // Lithuanian address
        ];
    }
}
