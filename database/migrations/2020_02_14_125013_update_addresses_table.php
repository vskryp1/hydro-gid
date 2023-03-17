<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->string('client_id',36)->nullable()->change();
            $table->uuid('temp_client_id')->nullable()->after('client_id');

            $table->foreign('client_id')
                  ->references('id')
                  ->on('clients')
                  ->onDelete('set null');

            $table->foreign('temp_client_id')
                  ->references('id')
                  ->on('temp_client_orders')
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
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('temp_client_id');
        });
    }
}
