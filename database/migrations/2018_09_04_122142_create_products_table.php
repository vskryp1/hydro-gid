<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	use App\Enums\ProductAvailability;
	use App\Enums\ProductSaleType;

	class CreateProductsTable extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up ()
		{
			Schema::create('products', function (Blueprint $table) {
				$table->uuid('id')->primary();
                $table->uuid('parent_id')->nullable()->index();
                $table->uuid('product_status_id')->nullable();
                $table->uuid('currency_id');
                $table->uuid('warranty_id');
                $table->string('sku');
				$table->tinyInteger('availability')->default(ProductAvailability::AVAILABLE);
				$table->tinyInteger('sale_type')->default(ProductSaleType::WHOLESALE_RETAIL);
				$table->string('alias');
				$table->string('technical_doc');
                $table->decimal('original_price', 12, 6)->unsigned()->default(0);
                $table->decimal('original_price_old', 12, 6)->unsigned()->default(0);
                $table->decimal('price', 12, 6)->unsigned()->default(0);
                $table->decimal('price_old', 12, 6)->unsigned()->default(0);
				$table->boolean('active')->default(true);
				$table->integer('position')->default(0);
				$table->integer('group_position')->default(0)->index();
                $table->float('rating', 2, 1)->default(0);
                $table->boolean('rating_calculate')->default(true);
                $table->string('video')->nullable();
                $table->date('expected_at')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->unique(['sku', 'deleted_at']);
				$table->unique(['alias', 'deleted_at']);

				$table->foreign('product_status_id')->references('id')->on('product_statuses')
					->onUpdate('cascade')->onDelete('no action');

				$table->foreign('currency_id')->references('id')->on('currencies')
					->onUpdate('cascade')->onDelete('no action');
			});

//            Schema::table('products', function (Blueprint $table) {
//                $table->foreign('parent_id')->references('id')->on('products')
//                    ->onDelete('set null');
//            });

			Schema::create('page_product', function (Blueprint $table) {
				//uuid
				$table->uuid('product_id');
				$table->uuid('page_id');
                $table->integer('order_sort');
				$table->boolean('is_main')->default(false);

				$table->foreign('product_id')->references('id')->on('products')
					->onUpdate('cascade')->onDelete('cascade');

				$table->foreign('page_id')->references('id')->on('pages')
					->onUpdate('cascade')->onDelete('cascade');

				$table->unique(['product_id', 'page_id']);

			});

			Schema::create('product_translations', function (Blueprint $table) {
				$table->uuid('id')->index();
				$table->uuid('product_id');
				$table->string('name');
				$table->text('introtext')->nullable();
				$table->text('description')->nullable();
				$table->string('seo_title')->nullable();
				$table->string('seo_keywords')->nullable();
				$table->string('seo_description')->nullable();
				$table->string('seo_canonical')->nullable();
				$table->string('seo_robots')->nullable();
				$table->text('seo_content')->nullable();
				$table->string('locale')->index();

				$table->unique(['product_id', 'locale']);
				$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			});

			Schema::create('product_images', function (Blueprint $table) {
				$table->uuid('id')->index();
				$table->uuid('product_id');
				$table->string('image');
				$table->integer('position')->default(0);
				$table->boolean('cover')->default(false);
				$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			});

			Schema::create('product_image_translations', function (Blueprint $table) {
				$table->uuid('id')->index();
				$table->uuid('product_image_id');
				$table->string('alt')->nullable();
				$table->string('title')->nullable();
				$table->string('locale')->index();

				$table->unique(['product_image_id', 'locale']);
				$table->foreign('product_image_id')->references('id')->on('product_images')->onDelete('cascade');
			});

			Schema::create('filter_value_product', function (Blueprint $table) {
				$table->uuid('filter_value_id');
				$table->uuid('product_id');
				$table->foreign('filter_value_id')->references('id')->on('filter_values')->onDelete('cascade');
				$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			});

            Schema::create('product_relations', function (Blueprint $table) {
                $table->uuid('product_id');
                $table->uuid('relation_product_id');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->foreign('relation_product_id')->references('id')->on('products')->onDelete('cascade');
            });

            Schema::create('product_warranties', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('product_id');
                $table->smallInteger('amount')->unsigned();
                $table->tinyInteger('position')->unsigned()->default(0);
                $table->decimal('price', 12, 6)->unsigned()->default(0);
                $table->boolean('active')->default(1);
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->timestamps();
            });

            Schema::create('product_similar', function (Blueprint $table) {
                $table->uuid('product_id');
                $table->uuid('similar_product_id');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->foreign('similar_product_id')->references('id')->on('products')->onDelete('cascade');
            });

		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down ()
		{
			Schema::dropIfExists('filter_value_product');
			Schema::dropIfExists('product_image_translations');
			Schema::dropIfExists('product_images');
			Schema::dropIfExists('product_translations');
			Schema::dropIfExists('page_product');
			Schema::dropIfExists('products');
			Schema::dropIfExists('product_waranties');
			Schema::dropIfExists('product_relations');
			Schema::dropIfExists('product_similar');
		}
	}
