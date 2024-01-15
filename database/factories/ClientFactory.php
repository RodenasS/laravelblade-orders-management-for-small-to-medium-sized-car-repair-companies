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

    private $lithuanianNames = [
        'Jonas', 'Petras', 'Antanas', 'Juozas', 'Kazimieras', 'Pranas', 'Mykolas', 'Algis', 'Darius', 'Gintaras',
    ];

    private $lithuanianSurnames = [
        'Kazlauskas', 'Petrauskas', 'Sakalauskas', 'Balčiūnas', 'Jankauskas', 'Stankevičius', 'Žemaitis', 'Lukšaitis', 'Gudaitis',
    ];

    public function definition()
    {
        $name = $this->faker->randomElement($this->lithuanianNames) . ' ' . $this->faker->randomElement($this->lithuanianSurnames);
        $firstName = $this->faker->randomElement($this->lithuanianNames);
        $lastName = $this->faker->randomElement($this->lithuanianSurnames);
        $email = strtolower($firstName . $lastName) . '@gmail.com';
        return [
            'name' => $name,
            'company_code' => $this->faker->unique()->numerify('##############'),
            'company_vat_code' => $this->faker->unique()->numerify('###########'),
            'email' => $email,
            'phone' => '+370' . $this->faker->numerify('6########'),
            'address' => $this->faker->address,
        ];
    }
}
