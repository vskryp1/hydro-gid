<?php

    use App\Models\Order\Payment;
    use Faker\Generator as Faker;

    $factory->define(Payment::class, function(Faker $faker) {
        return [
            'is_active'  => $faker->boolean,
            'is_default' => $faker->boolean,
            'type'       => $faker->randomNumber(2),
            'ru'         => [
                'name' => implode(' ', $faker->words(rand(1, 2))),
            ],
        ];
    });
