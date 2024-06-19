<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            //Hotel dan produk komen dulu, seed yang 3 atas dulu baru hotel dan produk
            // HotelTypeSeeder::class,
            // ProductTypeSeeder::class,
            // FasilitasSeeder::class,
            HotelSeeder::class,
            ProductSeeder::class
        ]);
    }
}
