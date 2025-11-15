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
        Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_type_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('product_category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('quantity')->nullable()->default(0);
            $table->boolean('no_quantity')->nullable()->default(0);
            $table->double('purchase_price', 16, 2)->nullable()->default(0);
            $table->double('sell_price', 16, 2)->nullable()->default(0);
            $table->string('delivery_type')->nullable();
            $table->boolean('active')->nullable()->default(1);
            $table->string('barcode')->nullable();
            $table->text('description')->nullable();
            $table->integer('sales_count')->default(0);
            $table->string('image')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->nullable()->default('pending');
            $table->boolean('product_approval')->default(true)->comment('Product Approval Status for clients');
            $table->text('rejected_reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
