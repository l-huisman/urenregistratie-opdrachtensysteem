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
                $table->string('name')->nullable(false);
                $table->date('start_date')->nullable(false);
                $table->date('end_date')->nullable(true);
                $table->decimal('budgeted_hours')->nullable(false);;
                $table->decimal('hourly_rate')->nullable(false);;
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
