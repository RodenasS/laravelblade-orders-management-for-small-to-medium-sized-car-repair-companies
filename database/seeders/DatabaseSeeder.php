<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Client::factory()->count(50)->create();
        Vehicle::factory()->count(100)->create();
        Order::factory()->count(70)->create();

        $user = User::factory()->create([
            'name' => 'adminas',
            'email' => 'admin@gmail.com',
            'password' => 'admin'
        ]);

        Order::factory(6)->create([
            'user_id' => $user->id
        ]);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//        Order::create([
//            'title' => 'Laravel Senior Developer',
//            'tags' => 'laravel, javascript',
//            'company' => 'Acme Corp',
//            'location' => 'Boston, MA',
//            'email' => 'email@email.com',
//            'website' => 'https://www.acme.com',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
//        ]);
//        Order::create([
//            'title' => 'Full-Stack Engineer',
//            'tags' => 'laravel, backend, api',
//            'company' => 'Stark Industries',
//            'location' => 'New York, NY',
//            'email' => 'email2@email.com',
//            'website' => 'https://www.starkindustries.com',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
//        ]);

    }
}
