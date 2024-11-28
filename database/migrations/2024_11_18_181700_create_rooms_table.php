<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id');
            $table->string('room_type')->comment('Single, Double, Suite');
            $table->decimal('price_per_night', 10, 2);
            $table->string('availability_status')->comment('Available, Occupied, Maintenance');
            $table->integer('floor_number');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};