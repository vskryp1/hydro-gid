<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDeliveriesTable
 */
class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('deliveries', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('currency_id');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(true);
            $table->unsignedSmallInteger('type')->default(1);
            $table->string('api_key')->nullable();
            $table->decimal('original_price', 12, 6)->default(0);
            $table->decimal('price', 12, 6)->default(0);
            $table->json('fields')->nullable();
            $table->json('required_fields')->nullable();
	        $table->integer('position')->default(0);
	        $table->timestamps();
            $table->softDeletes();

            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onUpdate('cascade')->onDelete('no action');
        });

        Schema::create('delivery_translations', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('delivery_id');
            $table->string('locale')->index();
            $table->unique(['delivery_id', 'locale']);
            $table->foreign('delivery_id')
                ->references('id')
                ->on('deliveries')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name');
            $table->text('description')->nullable();
        });

        Schema::create('delivery_places', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('delivery_id');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->string('api_id')->nullable();
            $table->decimal('original_price', 12, 6)->default(0);
            $table->decimal('price', 12, 6)->default(0);
            $table->integer('position')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('delivery_id')->references('id')->on('deliveries')
                ->onUpdate('cascade')->onDelete('no action');
        });

        Schema::create('delivery_place_translations', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('delivery_place_id');
            $table->string('locale')->index();
            $table->unique(['delivery_place_id', 'locale']);
            $table->foreign('delivery_place_id')
                ->references('id')
                ->on('delivery_places')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_translations');
        Schema::dropIfExists('deliveries');
    }
}
