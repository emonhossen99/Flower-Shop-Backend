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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->double('discount_price', 10, 2)->nullable();
            $table->double('price', 10, 2);
            $table->decimal('product_stock_qty', 10, 2)->nullable();
            $table->string('product_sku')->nullable();
            $table->longText('description');
            $table->longText('product_location')->nullable();
            $table->Text('short_description')->nullable();
            $table->Text('special_feature')->nullable();
            $table->enum('status',[0,1])->comment('0 = Pending ,1 = Publish');
            $table->enum('producttype',[0,1])->comment('0 = single ,1 = variable')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('tag')->nullable();
            $table->string('product_image')->nullable();
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
