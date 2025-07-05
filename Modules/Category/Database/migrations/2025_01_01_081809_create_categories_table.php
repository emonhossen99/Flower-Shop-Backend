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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('parent_id')->default(0);
            $table->string('submenu_id')->default(0);
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('tag')->nullable();
            $table->enum('status',[0,1])->comment('0 = Pending ,1 = Publish');
            $table->enum('home_page_show',[0,1])->comment('0 = No , 1 = Yes');
            $table->string('order_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
