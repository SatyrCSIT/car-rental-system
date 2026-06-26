<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('vehicle_id')
                ->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'active', 'completed', 'cancelled'])
                ->default('pending');
            $table->timestamps();
        });

        // CHECK constraint: Blueprint ไม่มีเมธอดตรง ๆ เลยเขียน SQL ดิบเสริม
        DB::statement('ALTER TABLE rentals ADD CONSTRAINT chk_rentals_dates CHECK (end_date > start_date)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
