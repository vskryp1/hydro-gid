<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

    class CreateSeoTables extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('seo_redirects', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->integer('status_code');
                $table->char('from');
                $table->char('to');
                $table->timestamps();
            });

            Schema::create('seo_metas', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->char('seo_title')->nullable();
                $table->char('seo_url')->unique();
                $table->char('seo_keywords')->nullable();
                $table->char('seo_description')->nullable();
                $table->char('seo_robots')->nullable();
                $table->char('seo_canonical')->nullable();
                $table->text('seo_content')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('seo_redirects');
            Schema::dropIfExists('seo_metas');
        }
    }
