<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocodes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('currency_id');
            $table->string('alias')->unique();
            $table->string('type')->nullable();
            $table->decimal('original_discount_size', 12, 6)->unsigned()->default(0);
            $table->decimal('discount_size', 12, 6)->unsigned()->default(0);
            $table->integer('use_count')->unsigned()->default(0);
            $table->integer('used')->unsigned()->default(0);
            $table->date('expiration_date')->nullable();
            $table->boolean('type_of_use')->default(0);
            $table->boolean('active')->default(0);
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onUpdate('cascade')->onDelete('no action');
        });

        Schema::create('order_promocode', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id');
            $table->uuid('promocode_id');

            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');

            $table->foreign('promocode_id')
                ->references('id')->on('promocodes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_promocode');
        Schema::dropIfExists('promocodes');
    }
}
