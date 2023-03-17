<?php

    use App\Models\Seo\SeoMetas;
    use Faker\Generator as Faker;

    $factory->define(SeoMetas::class, function(Faker $faker) {
        return [
            'seo_title'       => $faker->name,
            'seo_url'         => $faker->url,
            'seo_keywords'    => $faker->text(32),
            'seo_description' => $faker->text(64),
            'seo_robots'      => 'noindex, nofollow',
            'seo_canonical'   => $faker->url,
            'seo_content'     => $faker->text(191),
        ];
    });
