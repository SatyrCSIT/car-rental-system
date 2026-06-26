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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('rental_id')
                ->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('message');
            $table->timestamps();
        });

        // CHECK: คะแนนต้องอยู่ระหว่าง 1-5
        DB::statement('ALTER TABLE feedbacks ADD CONSTRAINT chk_feedbacks_rating CHECK (rating BETWEEN 1 AND 5)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
