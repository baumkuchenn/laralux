<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('hotels')->insert([
            [
                "nama" => "Grand Paradise Resort",
                "alamat" => "Jalan Pantai Indah No. 10",
                "no_telpon" => "+62 361 701234",
                "email" => "reservations@grandparadise.com",
                "bintang" => 4,
                "hoteltype_id" => 2
            ],
            [
                "nama_hotel" => "Puri Santika Hotel",
                "alamat" => "Jalan Darmo Permai I No. 171",
                "nomor_telepon" => "+62 31 5678910",
                "email" => "info@purisantikahotel.com",
                "bintang" => 3,
                "hoteltype_id" => 1
            ],
            [
                "nama_hotel" => "Motel Cendrawasih",
                "alamat" => "Jalan Diponegoro No. 22",
                "nomor_telepon" => "+62 31 2233444",
                "email" => "motelcendrawasih@gmail.com",
                "bintang" => 2,
                "hoteltype_id" => 3
            ]
        ]);
    }
}
