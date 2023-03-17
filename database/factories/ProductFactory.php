<?php

    use App\Models\Currency\Currency;
    use App\Models\Product\Product;
    use App\Models\Product\ProductStatus;
    use Faker\Generator as Faker;

    $factory->define(Product::class, function(Faker $faker, $attr) {
        return [
            'parent_id'          => $attr['parent_id'] ?? null,
            'group_position'     => $faker->numberBetween(0, 5),
            'currency_id'        => Currency::all()->random()->id,
            'product_status_id'  => ProductStatus::all()->random()->id,
            'sku'                => $faker->ean13,
            'alias'              => '',
            'original_price'     => $price = $faker->numberBetween(100, 10000),
            'price'              => $price,
            'price_old'          => $price_old = $faker->numberBetween(100, 10000),
            'original_price_old' => $price_old,
            'active'             => true,
            'position'           => $faker->numberBetween(50, 100),
            'rating'             => $faker->numberBetween(1, 5),
            'ru'                 => [
                'name'            => ucfirst(implode(' ', $faker->words(rand(1, 3)))),
                'description'     => $faker->text(500),
                'seo_title'       => ucfirst(implode(' ', $faker->words(rand(1, 3)))),
                'seo_keywords'    => implode(' ', $faker->words(rand(1, 3))),
                'seo_description' => implode(' ', $faker->words(rand(1, 3))),
                'seo_content'     => $faker->text(100),
            ],
        ];
    });
