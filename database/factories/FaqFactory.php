<?php

    use App\Models\Faq\Faq;
    use Faker\Generator as Faker;

    $factory->define(Faq::class, function(Faker $faker) {
        return [
            'active' => $faker->boolean,
            'code'   => $faker->randomDigitNotNull,
        ];
    });
