<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('alias');
            $table->boolean('active')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['alias', 'deleted_at']);
        });

        Schema::create('slider_translations', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('slider_id');
            $table->string('locale')->index();
            $table->unique(['slider_id', 'locale']);
            $table->foreign('slider_id')
                ->references('id')
                ->on('sliders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_translations');
        Schema::dropIfExists('sliders');
    }
}
