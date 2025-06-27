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
        Schema::create('bookings', function (Blueprint $table) { 
            // $table->uuid('id')->primary();
            $table->uuid('id')->primary(); 
            $table->foreignUuid('user_id')->constrained('users'); 
            $table->string('room_id')->constrained('rooms'); 
            $table->timestamp('check_in'); 
            $table->timestamp('check_out'); 
            $table->string('status'); 
            $table->string('guest_name'); 
            $table->string('guest_email'); 
            $table->string('guest_phone'); 
            $table->timestamp('from_date'); 
            $table->timestamp('to_date'); 
            $table->unique(['room_id','check_in','check_out',], 'bookings_room_id_check_in_check_out_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('bookings');
    }
};

