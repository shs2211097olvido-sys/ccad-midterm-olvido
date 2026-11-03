<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mother_id')
                ->constrained('mothers')
                ->cascadeOnDelete();

            $table->foreignId('obstetrician_id')
                ->constrained('obstetricians')
                ->restrictOnDelete();

            $table->foreignId('room_id')
                ->constrained('rooms')
                ->restrictOnDelete();

            $table->string('delivery_type');
            $table->dateTime('birth_datetime');
            $table->decimal('delivery_fee', 10, 2);
            $table->string('discharge_status');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};