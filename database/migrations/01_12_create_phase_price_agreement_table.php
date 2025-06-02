<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phase_price_agreement', function (Blueprint $table) {
            $table->foreignId('phase_id')->constrained()->cascadeOnDelete();
            $table->foreignId('price_agreement_id')->constrained()->cascadeOnDelete();
            $table->primary(['phase_id', 'price_agreement_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phase_price_agreement');
    }
};

