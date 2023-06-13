<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id,
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Listing::create([
        //     "title" => "laravel senior developer",
        //     "tags" => "laravel, javascript, react",
        //     "company" => "acme corp",
        //     "location" => "Boston, MA",
        //     "email" => "email@email.com",
        //     "website" => "https://www.acme.com",
        //     "description" => "laravel senior developer lorem lorem lorem lorem",
        // ]);

        // Listing::create([
        //     "title" => "PHP senior developer",
        //     "tags" => "laravel, javascript, react",
        //     "company" => "acme corp",
        //     "location" => "Boston, MA",
        //     "email" => "email@email.com",
        //     "website" => "https://www.acme.com",
        //     "description" => "laravel senior developer lorem lorem lorem lorem",
        // ]);


    }
}
