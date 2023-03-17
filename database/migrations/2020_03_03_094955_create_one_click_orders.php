<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOneClickOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('one_click_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('unique_id')->unique();
            $table->string('name');
            $table->string('phone');
            $table->uuid('product_id')->nullable();
            $table->boolean('status_new')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('one_click_orders');
    }
}
