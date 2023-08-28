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
        Schema::create('titleholders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('official');
            $table->char('phone',11)->nullable();
            $table->foreignId('organ_id')->constrained('organs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titleholders');
    }
};
