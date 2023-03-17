<?php

    use App\Models\Page\PageTemplate;
    use Faker\Generator as Faker;

    $factory->define(PageTemplate::class, function(Faker $faker) {
        return [
            'name'        => $faker->name,
            'folder'      => $faker->word,
            'active'      => $faker->boolean,
            'is_category' => $faker->boolean,
        ];
    });
