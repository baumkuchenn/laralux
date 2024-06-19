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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('producttype_id');
            $table->foreign('producttype_id')->references('id')->on('producttypes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['producttype_id']);
            $table->dropColumn(['producttype_id']);
        });
    }
};
