<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    /**
     * Class CreateClientsTable
     */
    class CreateClientsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(): void
        {
            Schema::create('clients', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('phone')->unique();
                $table->string('email')->unique();
                $table->boolean('is_legal_entity')->default(false);
                $table->string('company_name')->unique()->nullable();
                $table->string('edrpou')->unique()->nullable();
                $table->boolean('is_active')->default(false);
                $table->unsignedInteger('discount')->default(0);
                $table->boolean('is_percentage')->default(false);
                $table->string('password');
                $table->rememberToken();
                $table->timestamp('email_verified_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(): void
        {
            Schema::dropIfExists('clients');
        }
    }
