<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newborn_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('delivery_id')
                ->unique()
                ->constrained('deliveries')
                ->cascadeOnDelete();

            $table->string('baby_gender', 20);
            $table->decimal('birth_weight_kg', 4, 2);
            $table->decimal('birth_height_cm', 5, 1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newborn_records');
    }
};