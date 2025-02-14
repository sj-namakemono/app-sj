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
        Schema::create('delivery_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('file_name');
            $table->string('file_path');
            $table->foreignId('delivery_id')->nullable()->constrained('deliveries')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_files');
    }
};
