<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->integer('destination_id');
            $table->string('destination_name');
            $table->string('destination_country');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->date('travel_date');
            $table->date('return_date')->nullable();
            $table->integer('travelers')->default(1);
            $table->string('travel_style')->nullable();
            $table->text('special_requests')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};