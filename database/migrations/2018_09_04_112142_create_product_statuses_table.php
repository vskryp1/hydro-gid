<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_statuses', function (Blueprint $table) {
	        $table->uuid('id')->primary();
	        $table->integer('position')->default(0);
	        $table->boolean('active')->default(true);
	        $table->boolean('default')->default(false);
            $table->string('color')->nullable();
            $table->string('class')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_status_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_status_id');
            $table->string('name');
            $table->string('locale');

            $table->unique(['product_status_id','locale']);
            $table->foreign('product_status_id')->references('id')->on('product_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_status_translations');
        Schema::dropIfExists('product_statuses');
    }
}
