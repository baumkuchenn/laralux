<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('hotel_types')->insert([
            [
                "nama" => "City Hotel",
            ],
            [
                "nama" => "Residential Hotel",
            ],
            [
                "nama" => "Motel",
            ]
        ]);
    }
}
