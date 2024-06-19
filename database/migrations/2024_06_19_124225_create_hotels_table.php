<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_telpon');
            $table->string('email');
            $table->tinyInteger('bintang');
            $table->softDeletes();

            // $table->unsignedBigInteger('hoteltype_id');
            // $table->foreign('hoteltype_id')->references('id')->on('hoteltypes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
