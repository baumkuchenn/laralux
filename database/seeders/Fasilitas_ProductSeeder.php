<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Fasilitas_ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('fasilitas_product')->insert([
            [
                "fasilitas_id" => 1,
                "product_id" => 1
            ],
            [
                "fasilitas_id" => 2,
                "product_id" => 1
            ],
            [
                "fasilitas_id" => 3,
                "product_id" => 1
            ],
            [
                "fasilitas_id" => 4,
                "product_id" => 1
            ],
            [
                "fasilitas_id" => 5,
                "product_id" => 1
            ],
            [
                "fasilitas_id" => 6,
                "product_id" => 1
            ],
            [
                "fasilitas_id" => 1,
                "product_id" => 2
            ],
            [
                "fasilitas_id" => 2,
                "product_id" => 2
            ],
            [
                "fasilitas_id" => 3,
                "product_id" => 2
            ],
            [
                "fasilitas_id" => 4,
                "product_id" => 2
            ],
            [
                "fasilitas_id" => 5,
                "product_id" => 2
            ],
            [
                "fasilitas_id" => 6,
                "product_id" => 2
            ],
            [
                "fasilitas_id" => 1,
                "product_id" => 3
            ],
            [
                "fasilitas_id" => 2,
                "product_id" => 3
            ],
            [
                "fasilitas_id" => 3,
                "product_id" => 3
            ],
            [
                "fasilitas_id" => 4,
                "product_id" => 3
            ],
            [
                "fasilitas_id" => 5,
                "product_id" => 3
            ],
            [
                "fasilitas_id" => 6,
                "product_id" => 3
            ],
            [
                "fasilitas_id" => 1,
                "product_id" => 4
            ],
            [
                "fasilitas_id" => 2,
                "product_id" => 4
            ],
            [
                "fasilitas_id" => 3,
                "product_id" => 4
            ],
            [
                "fasilitas_id" => 5,
                "product_id" => 5
            ],
            [
                "fasilitas_id" => 1,
                "product_id" => 5
            ],
            [
                "fasilitas_id" => 2,
                "product_id" => 5
            ],
            [
                "fasilitas_id" => 3,
                "product_id" => 5
            ]
        ]);
    }
}
