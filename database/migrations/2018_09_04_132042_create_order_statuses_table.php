<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('position')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('default')->default(false);
            $table->boolean('processed')->default(false);
	        $table->string('color')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('order_status_translations', function(Blueprint $table)
        {
            $table->uuid('id')->primary();
            $table->uuid('order_status_id');
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['order_status_id','locale']);
            $table->foreign('order_status_id')
                ->references('id')->on('order_statuses')
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
        Schema::dropIfExists('order_status_translations');
        Schema::dropIfExists('order_statuses');
    }
}
