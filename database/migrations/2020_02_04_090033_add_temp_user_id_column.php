<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class AddTempUserIdColumn extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('orders', function(Blueprint $table) {
                $table->uuid('temp_client_id')->nullable()->after('user_id');


            });
            Schema::table('orders', function(Blueprint $table) {
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
            Schema::table('Orders', function(Blueprint $table) {
                $table->dropColumn('temp_client_orders_id');
            });
        }
    }
