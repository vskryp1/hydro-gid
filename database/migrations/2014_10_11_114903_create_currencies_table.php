<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->uuid('id')->primary();
	        $table->string('code', 3);
	        $table->string('name')->nullable();
	        $table->string('sign')->nullable();
	        $table->integer('position')->nullable();
	        $table->boolean('active')->default(true);
	        $table->boolean('default')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['code', 'deleted_at']);
        });

        Schema::create('courses', function (Blueprint $table){
        	$table->uuid('id')->primary();
        	$table->uuid('currency_id');
	        $table->decimal('course', 12, 6);
	        $table->timestamps();
	        $table->softDeletes();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies')
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
        Schema::dropIfExists('courses');
        Schema::dropIfExists('currencies');
    }
}
