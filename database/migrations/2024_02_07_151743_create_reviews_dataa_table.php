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
        Schema::create('reviews_data', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('reviews_id');
        $table->foreign('reviews_id')->references('id')->on('review')->onDelete('cascade');
        $table->string('image')->nullable();
        $table->text('description');
        $table->unsignedTinyInteger('rating');
        $table->string('icon')->nullable();
        $table->string('name')->nullable();
        $table->string('position')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews_dataa');
    }
};
