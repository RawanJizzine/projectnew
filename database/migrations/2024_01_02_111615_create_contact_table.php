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
        Schema::create('contact_data', function (Blueprint $table) {
            $table->id();

            $table->string('title_cta')->nullable();
            $table->text('description_cta')->nullable();
            $table->string('button_text_cta')->nullable();
            $table->string('image_cta')->nullable();
         
            $table->string('title_contact')->nullable();
            $table->text('first_description_contact')->nullable();
            $table->text('second_description_contact')->nullable();
            $table->text('tertiary_description_contact')->nullable();
            $table->string('image_contact')->nullable();
            $table->string('text_contact')->nullable();
            $table->text('description_contact')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('description_contact_two')->nullable();
            $table->string('text_button_contact')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_data');
    }
};
