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
            Schema::create('price_agreements', function (Blueprint $table) {
                $table->id();
                $table->date('start_date');
                $table->date('end_date')->nullable();
                $table->decimal('budgeted_hours');
                $table->decimal('hourly_rate');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('price_agreements');
        }
    };
