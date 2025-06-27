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
        Schema::create('room_images', function (Blueprint $table) { 
            // $table->uuid('id')->primary();
            $table->uuid('id')->primary(); 
            $table->string('path'); 
            $table->string('room_id')->constrained('rooms');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('room_images');
    }
};

