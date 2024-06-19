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
        //
        Schema::table('hotels', function (Blueprint $table) {
            $table->unsignedBigInteger('hoteltype_id');
            $table->foreign('hoteltype_id')->references('id')->on('hoteltypes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropForeign(['hoteltype_id']);
            $table->dropColumn(['hoteltype_id']);
        });
    }
};
