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
            $table->string('number')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->enum('driver_type', ['vendor_driver', 'platform_driver'])->nullable();
            $table->foreignId('neighborhood_id')->nullable()->constrained()->cascadeOnDelete();
            $table->double('tax')->nullable()->default(0);
            $table->double('shipping_price')->nullable()->default(0);
            $table->double('shipping_tax')->nullable()->default(0);
            $table->double('subtotal')->default(0)->nullable();
            $table->double('total')->nullable()->default(0);
            $table->enum('status', ['pending', 'accepted', 'waiting', 'waiting_for_drivers', 'assigned_to_driver', 'in_progress', 'done', 'refused'])->default('pending');
            $table->string('refused_reason')->nullable();
            $table->text('description')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('additional_phone')->nullable();
            $table->unsignedBigInteger('distance')->nullable()->default(0);
            $table->timestamp('delivery_time')->nullable();
            $table->string('place')->nullable();
            $table->text('address')->nullable();
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
