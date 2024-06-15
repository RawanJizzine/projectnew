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
        Schema::create('features_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('features_id');
            $table->foreign('features_id')->references('id')->on('features')->onDelete('cascade');
            $table->string('image');
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features_data');
    }
};
