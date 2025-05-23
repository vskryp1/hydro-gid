<?php

    use App\Models\User;
    use Faker\Generator as Faker;
    use Illuminate\Support\Str;

    $factory->define(User::class, function(Faker $faker) {
        return [
            'name'           => $faker->firstName,
            'email'          => $faker->unique()->safeEmail,
            'phone'          => $faker->phoneNumber,
            'avatar'         => null,
            'active'         => $faker->boolean,
            'notification'   => $faker->boolean,
            'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => Str::random(60),
        ];
    });
