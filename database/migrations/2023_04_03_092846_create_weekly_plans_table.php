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
        Schema::create('weekly_plans', function (Blueprint $table) {
            $table->id();
            $table->string('origin_city_id',5);
            $table->string('origin_terminal_id',5);
            $table->string('destination_city_id',5);
            $table->string('destination_terminal_id',5);
            $table->integer('moving_day');
            $table->integer('moving_hour');
            $table->integer('duration_minute');
            $table->integer('capacity');
            $table->string('bus_type',5);
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_plans');
    }
};
