<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePaymentsTable
 */
class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('payments', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_default')->default(false);
            $table->unsignedSmallInteger('type')->default(1);
            $table->string('api_key_public')->nullable();
            $table->string('api_key_private')->nullable();
            $table->boolean('api_key_sandbox')->default(true);
	        $table->integer('position')->default(0);
	        $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('payment_translations', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('payment_id');
            $table->string('locale')->index();
            $table->unique(['payment_id', 'locale']);
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_translations');
        Schema::dropIfExists('payments');
    }
}
