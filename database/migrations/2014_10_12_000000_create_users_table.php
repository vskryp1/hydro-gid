<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    /**
     * Class CreateUsersTable
     */
    class CreateUsersTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(): void
        {
            Schema::create('users', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->string('avatar')->nullable();
                $table->string('password');
                $table->boolean('active')->default(false);
                $table->boolean('notification')->default(false);

                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();

                $table->unique(['email', 'deleted_at']);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('users');
        }
    }
