<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGlobalWarranties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'product_warranties',
            function (Blueprint $table) {
                $table->uuid('page_id')->index()->after('product_id')->nullable();
                $table->string('product_id', 36)->nullable()->change();

                $table->foreign('page_id')->references('id')
                      ->on('pages')
                      ->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_warranties', function (Blueprint $table) {
            $table->dropColumn('page_id');
        });
    }
}
