<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('producttypes')->insert([
            [
                "nama" => "Standar",
            ],
            [
                "nama" => "Deluxe",
            ],
            [
                "nama" => "Superior",
            ],
            [
                "nama" => "Presidential",
            ]
        ]);
    }
}
