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
        Schema::create('faq_dynamic', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('faq_id');
            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('description', 255)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_dynamic');
    }
};
