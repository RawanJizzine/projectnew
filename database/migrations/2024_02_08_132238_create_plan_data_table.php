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
        Schema::create('plan_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->decimal('monthly_price', 8, 2)->nullable();
            $table->decimal('yearly_price', 8, 2)->nullable();
            $table->decimal('total_price', 8, 2)->nullable();
            $table->string('text_button')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_data');
    }
};