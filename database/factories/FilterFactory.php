<?php

    use App\Models\Filters\Filter;
    use App\Models\Filters\FilterType;
    use Faker\Generator as Faker;

    $factory->define(Filter::class, function(Faker $faker) {
        return [
            'filter_type_id' => FilterType::all()->random()->id,
            'alias'          => $faker->unique()->slug(1),
            'active'         => true,
            'is_option'      => false,
            'position'       => $faker->randomNumber(),
            'ru'             => [
                'name'        => implode(' ', $faker->words(rand(1, 2))),
                'description' => $faker->text(100),
            ],
        ];
    });
