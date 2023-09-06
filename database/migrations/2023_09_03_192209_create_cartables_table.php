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
        //cartables
        Schema::create('cartables', function (Blueprint $table) {
            $table->id();
            $table->boolean('checked')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('letter_id')->constrained('letters')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartables');
    }
};
