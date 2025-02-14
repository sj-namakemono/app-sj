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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('product_name');
            $table->integer('count')->default(1);
            $table->text('departure');
            $table->text('destination');
            $table->dateTime('departure_datetime')->nullable();
            $table->dateTime('arrival_datetime')->nullable();
            $table->dateTime('receipt_datetime')->nullable();
            $table->integer('order_number')->nullable();
            $table->text('client');
            $table->foreignId('delivery_people_id')->nullable()->constrained('delivery_people');
            $table->boolean('is_deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
