<?php

    use App\Models\Page\PageTranslation;
    use Faker\Generator as Faker;

    $factory->define(PageTranslation::class, function(Faker $faker) {
        $locales = [];

        foreach (Setting::get('locales') as $lang => $locale) {
            $locales[$lang] = [
                'name'            => $faker->title,
                'introtext'       => $faker->text(30),
                'description'     => $faker->text(200),
                'seo_title'       => $faker->text(30),
                'seo_keywords'    => $faker->text(30),
                'seo_description' => $faker->text(200),
                'seo_desc'        => $faker->text(200),
                'seo_robots'      => $faker->text(30),
                'seo_canonical'   => $faker->url,
            ];
        };

        return $locales;
    });
