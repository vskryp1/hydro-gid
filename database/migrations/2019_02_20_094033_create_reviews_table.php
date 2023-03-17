<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateReviewsTable extends Migration
    {
        public function up(): void
        {
            Schema::create('reviews', function(Blueprint $table) {
                $table->uuid('id')->primary();
                $table->float('rating', 2, 1)->nullable()->default(0);
                $table->string('username');
                $table->string('email');
                $table->text('comment')->nullable();
                $table->text('answer')->nullable();
                $table->boolean('is_active')->default(false);
                $table->uuid('reviewable_id');
                $table->string('reviewable_type');
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('reviews');
        }
    }
