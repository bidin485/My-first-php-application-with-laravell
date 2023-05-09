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
        Schema::create('guest_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('email');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('amount_paid');
            $table->integer('balance');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('hostel_room_id');
            $table->unsignedBigInteger('bed_id');
            $table->timestamps();

            
            $table->index('user_id');
            $table->index('hostel_room_id');
            $table->index('bed_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_bookings');
    }
};
