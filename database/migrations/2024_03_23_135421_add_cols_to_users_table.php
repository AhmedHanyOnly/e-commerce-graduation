<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('commercial_record_image')->nullable();
            $table->string('commercial_record_number')->nullable();
            $table->string('bank_account')->nullable();
            $table->foreignId('neighborhood_id')->nullable()->constrained()->nullOnDelete();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->double('balance')->default(0)->nullable();
            $table->string('from_time')->nullable();
            $table->string('to_time')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
