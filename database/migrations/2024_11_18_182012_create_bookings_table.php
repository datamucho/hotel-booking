<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->foreignId('customer_id')->constrained('customers', 'customer_id');
            $table->foreignId('room_id')->constrained('rooms', 'room_id');
            $table->timestamp('booking_date');
            $table->timestamp('check_in_date');
            $table->timestamp('check_out_date');
            $table->string('status')->comment('Confirmed, Cancelled, Pending');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};