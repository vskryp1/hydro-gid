<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductStatusEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_statuses', function (Blueprint $table) {
            $table->unsignedSmallInteger('alias')->after('position');
        });
        Artisan::call('db:seed', ['--class' => 'ProductStatusesAliasSeeder']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_statuses', function (Blueprint $table) {
            $table->dropColumn('alias');
        });
    }
}
