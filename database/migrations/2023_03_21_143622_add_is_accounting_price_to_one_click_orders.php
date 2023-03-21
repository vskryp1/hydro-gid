<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAccountingPriceToOneClickOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('one_click_orders', function (Blueprint $table) {
            $table->boolean('is_accounting_price')->default(false)->after('status_new');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('one_click_orders', function (Blueprint $table) {
            $table->dropColumn('is_accounting_price');
        });
    }
}
