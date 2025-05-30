<?php

use App\Models\Phase;
use App\Models\PriceAgreement;
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
        Schema::create('phase_price_agreement', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Phase::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PriceAgreement::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
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
