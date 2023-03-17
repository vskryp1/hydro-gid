<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class UpdateFaqTranslationsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('faq_translations', function(Blueprint $table) {
                $table->text('question')->change();
                $table->text('answer')->change();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('faq_translations', function(Blueprint $table) {
                $table->dropColumn('question');
                $table->dropColumn('answer');
            });
        }
    }
