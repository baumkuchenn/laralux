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
        Schema::create('memberships', function (Blueprint $table) {
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->foreignId('transactions_id')->constrained()->onDelete('cascade');
            $table->integer('points');
            $table->timestamps();

            // Define the primary key
            $table->primary(['users_id', 'transactions_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
