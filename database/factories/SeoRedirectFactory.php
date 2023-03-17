<?php

    use App\Models\Seo\SeoRedirects;
    use Faker\Generator as Faker;

    $factory->define(SeoRedirects::class, function(Faker $faker) {
        return [
            'status_code' => '301',
            'from'        => $faker->url,
            'to'          => $faker->url,
        ];
    });
