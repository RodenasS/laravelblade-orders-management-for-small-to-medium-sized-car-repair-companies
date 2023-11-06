<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // Make sure this is unsignedBigInteger
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('brand');
            $table->string('model');
            $table->integer('mileage');
            $table->date('first_registration');
            $table->string('license_plate')->unique();
            $table->string('vin')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
