<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            [
                "nama" => "Superior Suite",
                "hotel_id" => 1,
                "price" => 2000000,
                "producttype_id" => 3,
            ],
            [
                "nama" => "Presidential Suite",
                "hotel_id" => 1,
                "price" => 3000000,
                "producttype_id" => 4,
            ],
            [
                "nama" => "Deluxe Room",
                "hotel_id" => 2,
                "price" => 1000000,
                "producttype_id" => 2,
            ],
            [
                "nama" => "Standar Room",
                "hotel_id" => 2,
                "price" => 1500000,
                "producttype_id" => 1,
            ],
            [
                "nama" => "Standard Room",
                "hotel_id" => 3,
                "price" => 200000,
                "producttype_id" => 1,
            ],
        ]);
    }
}
