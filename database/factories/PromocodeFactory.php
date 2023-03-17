<?php

    use App\Models\Currency\Currency;
    use App\Models\Product\Promocode;
    use Faker\Generator as Faker;

    $factory->define(Promocode::class, function(Faker $faker) {
        return [
            'currency_id' => Currency::all()->random()->id,
            'alias'       => $faker->url,
            'use_count'   => $faker->randomDigitNotNull,
            'active'      => $faker->boolean,
        ];
    });
