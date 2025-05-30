<?php

use App\Models\Phase;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Phase::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('estimated_hours', 8, 2)->default(0.00);
            // TODO: The question is whether that a task could have a price agreement itself.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
