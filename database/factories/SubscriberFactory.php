<?php

    use App\Models\Subscriber;
    use Faker\Generator as Faker;

    $factory->define(Subscriber::class, function(Faker $faker) {
        return [
            'email' => $faker->email,
        ];
    });
