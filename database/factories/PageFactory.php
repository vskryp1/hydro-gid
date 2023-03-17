<?php

    use App\Models\Page\Page;
    use App\Models\Page\PageTemplate;
    use Faker\Generator as Faker;

    $factory->define(Page::class, function(Faker $faker) {
        $name = $faker->word;

        return [
            'page_template_id' => factory(PageTemplate::class)->create()->id,
            'parent_page_id'   => null,
            'alias'            => $faker->slug,
            'position'         => $faker->randomNumber(),
            'active'           => $faker->boolean,
            'only_auth'        => $faker->boolean,
            'use_sitemap'      => $faker->boolean,
            'ru'               => [
                'name' => $name,
            ],
            'uk'               => [
                'name' => $name,
            ],
        ];
    });
