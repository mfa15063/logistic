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
        Schema::table('site_infos', function (Blueprint $table) {
            if(Schema::hasColumn('site_infos','location')){
                $table->text('location')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inqueries', function (Blueprint $table) {
            if(Schema::hasColumn('site_infos','location')){
                $table->string('location')->nullable()->change();
            }
        });
    }
};
