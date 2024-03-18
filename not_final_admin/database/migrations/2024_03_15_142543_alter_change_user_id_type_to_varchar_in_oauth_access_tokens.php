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
        Schema::table('oauth_access_tokens', function (Blueprint $table) {
            if(Schema::hasColumn('oauth_access_tokens','user_id ')){
                $table->string('user_id',20)->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('oauth_access_tokens', function (Blueprint $table) {
            if(Schema::hasColumn('oauth_access_tokens','user_id ')){
                $table->integer('user_id',20)->change();
            }
        });
    }
};
