<?php

    use App\Models\Filters\FilterValue;
    use Faker\Generator as Faker;

    $factory->define(FilterValue::class, function(Faker $faker, $attr) {
        $slug = $faker->unique($attr['filter_id'])->slug(1);

        return [
            'alias'    => $slug,
            'active'   => true,
            'position' => $faker->randomNumber(),
            'ru'       => [
                'name' => $slug,
            ],
        ];
    });
