<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRegionsTable
 */
class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('regions', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_default')->default(false);
	        $table->integer('position')->default(0);
	        $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('region_translations', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('region_id');
            $table->string('locale')->index();
            $table->unique(['region_id', 'locale']);
            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
        });

        Schema::create('payment_region', function(Blueprint $table) {
            $table->uuid('payment_id');
            $table->uuid('region_id');
            $table->primary(['payment_id', 'region_id']);
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('delivery_region', function(Blueprint $table) {
            $table->uuid('delivery_id');
            $table->uuid('region_id');
            $table->primary(['delivery_id', 'region_id']);
            $table->foreign('delivery_id')
                ->references('id')
                ->on('deliveries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_region');
        Schema::dropIfExists('payment_region');
        Schema::dropIfExists('region_translations');
        Schema::dropIfExists('regions');
    }
}
