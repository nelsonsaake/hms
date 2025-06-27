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
        Schema::create('rooms', function (Blueprint $table) {  
            $table->uuid('id')->primary(); 
            $table->string('type'); 
            $table->decimal('price', 10, 2); 
            $table->integer('beds'); 
            $table->string('description')->nullable(); 
            $table->string('status'); 
            $table->integer('floor'); 
            $table->integer('number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('rooms');
    }
};

