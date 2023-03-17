<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_items', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('slider_id');
            $table->boolean('active')->default(true);
            $table->integer('position')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('slider_id')
                ->references('id')
                ->on('sliders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('slider_item_translations', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('slider_item_id');
            $table->string('locale')->index();
            $table->unique(['slider_item_id', 'locale']);
            $table->foreign('slider_item_id')
                ->references('id')
                ->on('slider_items')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('alt')->nullable();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_item_translations');
        Schema::dropIfExists('slider_items');
    }
}
