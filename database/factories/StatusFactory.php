<?php

    use App\Models\Product\ProductStatus;
    use Faker\Generator as Faker;

    $factory->define(ProductStatus::class, function(Faker $faker) {
        return [
            'position' => $faker->randomDigitNotNull,
            'active'   => $faker->boolean,
            'color'    => $faker->colorName,
            'class'    => $faker->text(16),
        ];
    });
