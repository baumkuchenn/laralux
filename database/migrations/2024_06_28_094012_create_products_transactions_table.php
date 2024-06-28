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
        Schema::create('products_transactions', function (Blueprint $table) {
            $table->foreignId('products_id')->constrained()->onDelete('cascade');
            $table->foreignId('transactions_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('sub_total');
            $table->timestamps();

            // Define the primary key
            $table->primary(['products_id', 'transactions_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_transactions');
    }
};
