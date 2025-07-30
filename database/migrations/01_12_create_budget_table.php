<?php

use App\Models\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->enum('type', ['HOURLY', 'FIXED', 'INTERNAL']);
            $table->decimal('price_per_unit', 10)->default(0.00);
            $table->decimal('max_units', 10)->default(0.00);
            $table->foreignIdFor(Project::class);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
