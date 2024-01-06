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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_img')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_img');
            $table->dropColumn('address');
            $table->dropColumn('contact_no');
            $table->dropColumn('city');
            $table->dropColumn('country');
        });
    }
};
