<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class UpdateService extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('service_orders', function(Blueprint $table) {
                $table->string('username')->nullable()->change();
                $table->string('email')->nullable()->change();
            });

        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('service_orders', function(Blueprint $table) {
                $table->dropColumn('username');
                $table->dropColumn('email');
            });

        }
    }
