<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
        });

        Schema::create('template_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('template_id');
            $table->string('name');
            $table->text('body')->nullable();
            $table->string('locale')->index();

            $table->unique(['template_id','locale']);
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
        });

        Schema::create('mail_templates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->integer('current')->default(0);
            $table->integer('all')->default(0);
            $table->string('template_id');
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
        Schema::dropIfExists('template_translations');
        Schema::dropIfExists('templates');
        Schema::dropIfExists('mail_templates');
    }
}
