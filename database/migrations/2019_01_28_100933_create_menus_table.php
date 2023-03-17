<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    /**
     * Class CreateMenusTable
     */
    class CreateMenusTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(): void
        {
            Schema::create('menus', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('page_id')->nullable();
                $table->string('alias')->unique();
                $table->integer('type')->default(1);
                $table->timestamps();
            });

            Schema::create('menu_items', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('menu_id');
                $table->uuid('menu_item_id')->nullable();
                $table->uuid('menuable_id')->nullable();
                $table->string('menuable_type')->nullable();
                $table->integer('type')->default(1);
                $table->integer('position')->default(0);
                $table->timestamps();

                $table->foreign('menu_id')
                    ->references('id')
                    ->on('menus')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });

            Schema::create('menu_item_translations', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('menu_item_id');
                $table->string('name')->nullable();
                $table->string('link')->nullable();
                $table->string('image')->nullable();
                $table->string('properties')->nullable();
                $table->string('locale')->index();

                $table->foreign('menu_item_id')
                    ->references('id')
                    ->on('menu_items')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(): void
        {
            Schema::dropIfExists('menu_item_translations');
            Schema::dropIfExists('menu_items');
            Schema::dropIfExists('menus');
        }
    }
