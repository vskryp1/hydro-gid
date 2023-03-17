<?php

    use App\Models\Currency\Currency;
    use App\Models\Order\Delivery;
    use Faker\Generator as Faker;

    $factory->define(Delivery::class, function(Faker $faker) {
        return [
            'currency_id' => Currency::all()->random()->id,
            'is_active'   => $faker->boolean,
            'is_default'  => $faker->boolean,
            'type'        => $faker->randomNumber(2),
            'ru'          => [
                'name' => implode(' ', $faker->words(rand(1, 2))),
            ],
        ];
    });
