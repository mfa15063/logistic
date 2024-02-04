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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('no_of_packet')->nullable();
            $table->string('packet_weight')->nullable();
            $table->string('packet_width')->nullable();
            $table->string('packet_height')->nullable();
            $table->string('packet_length')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('no_of_packet');
            $table->dropColumn('packet_weight');
            $table->dropColumn('packet_width');
            $table->dropColumn('packet_height');
            $table->dropColumn('packet_length');
        });
    }
};
