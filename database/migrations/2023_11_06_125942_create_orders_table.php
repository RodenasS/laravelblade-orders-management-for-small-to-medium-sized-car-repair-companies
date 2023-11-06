<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('status')->default('priimtas');
            $table->dateTime('estimated_start')->nullable();
            $table->dateTime('estimated_end')->nullable();
            $table->date('date');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->text('special_conditions')->nullable();
            $table->decimal('total_ex_vat', 10, 2);
            $table->decimal('vat', 10, 2);
            $table->decimal('total_inc_vat', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
