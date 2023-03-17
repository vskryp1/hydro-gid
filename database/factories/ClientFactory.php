<?php

    use App\Models\Client\Client;
    use Faker\Generator as Faker;
    use Illuminate\Support\Str;

    $factory->define(Client::class, function(Faker $faker) {
        return [
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'phone'             => $faker->unique()->phoneNumber,
            'email'             => $faker->unique()->email,
            'is_legal_entity'   => $faker->boolean(20),
            'company_name'      => $faker->unique()->company,
            'edrpou'            => $faker->unique()->bankAccountNumber,
            'is_active'         => $faker->boolean(80),
            'discount'          => $faker->numberBetween(5, 10),
            'is_percentage'     => $faker->boolean(80),
            'email_verified_at' => $faker->date(),
            'remember_token'    => Str::random(60),
            'password'          => '$2y$12$tXUVr7ZgBAT6HNZcDal3JeQlJhuBn54jWJtwS0uXnAH726SQY6lzq', // meganote
        ];
    });
