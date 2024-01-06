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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('status')->nullable();
            $table->string('received_address',)->nullable();
            $table->string('received_city')->nullable();
            $table->string('received_country')->nullable();
            $table->string('delivered_address')->nullable();
            $table->string('delivered_city')->nullable();
            $table->string('delivered_country')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('product_pic')->nullable();
            $table->string('price')->nullable();
            $table->date('received_date')->nullable();
            $table->date('delivered_date')->nullable();
            $table->string('payment_recipt')->nullable();
            $table->boolean('order_delivered')->default(0);
            $table->boolean('approved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
