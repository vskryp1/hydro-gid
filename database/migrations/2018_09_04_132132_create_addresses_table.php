<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateAddressesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(): void
        {
            Schema::create('addresses', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('client_id');
                $table->uuid('region_id')->nullable();
                $table->string('city');
                $table->string('street');
                $table->string('house');

                $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');
                $table->foreign('region_id')
                    ->references('id')
                    ->on('regions')
                    ->onDelete('set null');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(): void
        {
            Schema::dropIfExists('addresses');
        }
    }
