<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateFiltersTable extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up ()
		{
			Schema::create('filter_types', function (Blueprint $table) {
				$table->uuid('id')->primary();
				$table->string('name');
				$table->string('file');
				$table->timestamps();
				$table->softDeletes();
			});

			Schema::create('filters', function (Blueprint $table) {
				$table->uuid('id')->primary();
				$table->uuid('filter_type_id');
				$table->integer('position')->default(0);
				$table->string('alias');
				$table->boolean('active')->default(true);
				$table->boolean('is_option')->default(false)->comment('filter will be use in cart');
				$table->boolean('is_technical')->default(false)->comment('techical filter');
				$table->timestamps();
				$table->softDeletes();

				$table->unique(['alias', 'deleted_at']);

				$table->foreign('filter_type_id')
					->references('id')
					->on('filter_types')
					->onUpdate('cascade')
					->onDelete('cascade');
			});

			Schema::create('filter_translations', function (Blueprint $table) {
				$table->uuid('id')->primary();
				$table->uuid('filter_id');
				$table->string('name');
				$table->text('description')->nullable();
				$table->string('locale')->index();

				$table->unique(['filter_id', 'locale']);

				$table->foreign('filter_id')
					->references('id')
					->on('filters')
					->onDelete('cascade');
			});

			Schema::create('filter_values', function (Blueprint $table) {
				$table->uuid('id')->primary();
				$table->uuid('filter_id');
				$table->integer('position')->default(0);
				$table->boolean('active')->default(true);
				$table->string('alias');
				$table->timestamps();
				$table->softDeletes();

				$table->unique(['filter_id', 'alias', 'deleted_at']);

				$table->foreign('filter_id')
					->references('id')
					->on('filters')
					->onUpdate('cascade')
					->onDelete('cascade');
			});

			Schema::create('filter_value_translations', function (Blueprint $table) {
				$table->uuid('id')->primary();
				$table->uuid('filter_value_id');
				$table->string('name');
				$table->string('locale')->index();

				$table->unique(['filter_value_id', 'locale']);

				$table->foreign('filter_value_id')
					->references('id')
					->on('filter_values')
					->onDelete('cascade');
			});

			Schema::create('filter_page', function (Blueprint $table) {
				$table->uuid('filter_id');
				$table->uuid('page_id');

				$table->foreign('filter_id')
					->references('id')
					->on('filters')
					->onDelete('cascade');

				$table->foreign('page_id')
					->references('id')
					->on('pages')
					->onDelete('cascade');
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down ()
		{
			Schema::dropIfExists('filter_page');
			Schema::dropIfExists('filter_value_translations');
			Schema::dropIfExists('filter_values');
			Schema::dropIfExists('filter_translations');
			Schema::dropIfExists('filters');
			Schema::dropIfExists('filter_types');
		}
	}
