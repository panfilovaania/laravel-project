<?php

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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('timesheet_id')->unique()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('booking_status_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('persons');
            $table->decimal('total_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
