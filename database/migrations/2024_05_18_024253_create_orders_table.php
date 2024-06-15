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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('items')->nullable();
        
            $table->string('customfullName');
            $table->string('customphoneNumber');
            $table->string('custommodalemail');
            $table->string('modalAddressCountry');
            $table->text('customaddress');
            $table->string('customplace');
            $table->boolean('customdelivery');
            $table->boolean('switchonOmt');
            $table->boolean('switchondelivery');
            $table->decimal('total_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
