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
        Schema::table('website_views', function (Blueprint $table) {
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_views', function (Blueprint $table) {
            $table->dropColumn(['lat', 'long', 'address']);
        });
    }
};
