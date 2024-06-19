<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('fasilitas')->insert([
            [
                "nama" => "AC",
                "deskripsi" => "Air Conditioner"
            ],
            [
                "nama" => "WiFi",
                "deskripsi" => "Wireless internet connection"
            ],
            [
                "nama" => "TV Kabel",
                "deskripsi" => "Cable TV channels"
            ],
            [
                "nama" => "Kolam Renang",
                "deskripsi" => "Swimming pool"
            ],
            [
                "nama" => "Restoran",
                "deskripsi" => "Restaurant"
            ],
            [
                "nama" => "Gym",
                "deskripsi" => "Fitness center"
            ]
        ]);
    }
}
