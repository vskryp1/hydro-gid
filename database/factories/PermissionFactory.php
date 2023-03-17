<?php

    use App\Models\User\Permission;
    use Faker\Generator as Faker;

    $factory->define(Permission::class, function(Faker $faker) {
        return [
            'name' => $faker->word,
        ];
    });
