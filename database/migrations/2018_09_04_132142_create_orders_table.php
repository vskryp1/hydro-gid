<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
	        $table->string('unique_id')->unique();
	        $table->uuid('client_id')->nullable();
	        $table->uuid('user_id')->nullable();
	        $table->uuid('address_id')->nullable();
	        $table->uuid('order_status_id')->nullable();
	        $table->uuid('currency_id')->nullable();
	        $table->uuid('region_id')->nullable();
	        $table->uuid('delivery_id')->nullable();
	        $table->uuid('promocode_id')->nullable();
	        $table->uuid('payment_id')->nullable();
	        $table->string('place_id')->nullable();
	        $table->string('warehouse_id')->nullable();
	        $table->string('ttn')->nullable();
	        $table->string('locale');
	        $table->decimal('delivery_price',12, 6)->unsigned()->default(0);
            $table->decimal('discount', 12, 6)->unsigned()->default(0);
            $table->decimal('total_price', 15, 6)->unsigned();
	        $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')
                ->references('id')->on('clients')
                ->onDelete('set null');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('address_id')
                ->references('id')->on('addresses')
                ->onDelete('set null');

            $table->foreign('currency_id')
                ->references('id')->on('currencies')
                ->onDelete('set null');

            $table->foreign('place_id')
                ->references('id')->on('delivery_places')
                ->onDelete('set null');

	        $table->foreign('order_status_id')
		        ->references('id')->on('order_statuses')
                ->onDelete('set null');

	        $table->foreign('region_id')
		        ->references('id')->on('regions')
                ->onDelete('set null');

	        $table->foreign('delivery_id')
		        ->references('id')->on('deliveries')
                ->onDelete('set null');

	        $table->foreign('payment_id')
		        ->references('id')->on('payments')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
