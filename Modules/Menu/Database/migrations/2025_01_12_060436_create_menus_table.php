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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('url');
            $table->string('target')->default(0);
            $table->string('order_by');
            $table->string('parent_id')->default(0);
            $table->string('child_id')->default(0);
            $table->enum('status',[0,1])->comment('0 = Pending , 1 = Active');
            $table->enum('position',[0,1,2,3])->comment('0 = Menu , 1 = Footer 1, 2 = Footer 2, 3 = Footer 3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
