<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Service extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_orders', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedSmallInteger('type');
            $table->string('username');
            $table->string('phone');
            $table->string('email');
            $table->uuid('page_id')->nullable();
            $table->text('comment')->nullable();
            $table->string('file')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('call_me')->default(false);
            $table->timestamps();

            $table->foreign('page_id')
                ->references('id')
                ->on('pages')
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
        Schema::dropIfExists('service_orders');
    }
}
