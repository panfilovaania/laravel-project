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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timesheet_type_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->smallInteger('start_day');
            $table->smallInteger('end_day');
            $table->boolean('is_repeat')->default(0);
            $table->date('is_valid_from');
            $table->date('is_valid_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timesheets');
    }
};
