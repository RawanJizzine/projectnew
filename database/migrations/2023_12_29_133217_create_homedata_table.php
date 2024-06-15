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
        Schema::create('homedata', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->text('main_description'); 
            $table->text('secondary_description'); 
            $table->string('button_text'); 
            $table->string('image_link_dashboard'); 
            $table->string('image_link_element'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homedata');
    }
};
