<?php

    use App\Models\Page\PageAdditionalFieldType;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Support\Str;

    /**
     * Class CreatePages
     */
    class CreatePages extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(): void
        {
            Schema::create('page_templates', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name')->index();
                $table->string('folder')->index();
                $table->boolean('active')->default(true);
                $table->boolean('is_category')->default(false);

                $table->timestamps();
                $table->softDeletes();

                $table->unique(['name', 'deleted_at']);
                $table->unique(['folder', 'deleted_at']);
            });

            Schema::create('pages', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('page_template_id');
                $table->uuid('parent_page_id')->nullable();
                $table->string('alias')->index();
                $table->unsignedInteger('position')->default(0);
                $table->boolean('active')->default(true);
                $table->boolean('only_auth')->default(false);
                $table->boolean('use_sitemap')->default(true);

                $table->timestamps();
                $table->softDeletes();

                $table->unique(['alias', 'deleted_at']);

                $table->foreign('page_template_id')
                    ->references('id')
                    ->on('page_templates')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });

            Schema::create('page_translations', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('page_id');
                $table->string('name');
                $table->string('locale')->index();
                $table->text('introtext')->nullable();
                $table->text('description')->nullable();
                $table->string('seo_title')->nullable();
                $table->string('seo_keywords')->nullable();
                $table->string('seo_description')->nullable();
                $table->string('seo_canonical')->nullable();
                $table->string('seo_robots')->nullable();
                $table->text('seo_content')->nullable();

                $table->unique(['page_id', 'locale']);

                $table->foreign('page_id')
                    ->references('id')
                    ->on('pages')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });

            Schema::create('page_additional_field_types', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('type');
                $table->boolean('active')->default(true);
                $table->timestamps();
            });

            PageAdditionalFieldType::insert([
                ['type' => 'text', 'id' => Str::uuid()->toString()],
                ['type' => 'file', 'id' => Str::uuid()->toString()],
                ['type' => 'textarea', 'id' => Str::uuid()->toString()],
            ]);

            Schema::create('page_additional_fields', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('key')->unique();
                $table->text('default')->nullable();
                $table->uuid('page_template_id');
                $table->uuid('page_additional_field_type_id');
                $table->boolean('active')->default(false);
                $table->timestamps();

                $table->foreign('page_template_id')
                    ->references('id')
                    ->on('page_templates')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->foreign('page_additional_field_type_id')
                    ->references('id')
                    ->on('page_additional_field_types')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });

            Schema::create('page_additional_field_values', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('page_id');
                $table->uuid('page_additional_field_id');
                $table->timestamps();

                $table->unique(['page_id', 'page_additional_field_id'], 'name_additional_field_value');

                $table->foreign('page_id')
                    ->references('id')
                    ->on('pages')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->foreign('page_additional_field_id', 'p_a_f')
                    ->references('id')
                    ->on('page_additional_fields')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });

            Schema::create('page_additional_field_value_translations', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('page_additional_field_value_id');
                $table->text('value')->nullable();
                $table->string('locale')->index();

                $table->unique(['page_additional_field_value_id', 'locale'], 'name_additional_field_value_locale_unique');

                $table->foreign('page_additional_field_value_id', 'p_a_f_value')
                    ->references('id')
                    ->on('page_additional_field_values')
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
            Schema::dropIfExists('page_additional_field_value_translations');
            Schema::dropIfExists('page_additional_field_values');
            Schema::dropIfExists('page_additional_fields');
            Schema::dropIfExists('page_additional_field_types');
            Schema::dropIfExists('page_translations');
            Schema::dropIfExists('pages');
            Schema::dropIfExists('page_templates');
        }
    }
