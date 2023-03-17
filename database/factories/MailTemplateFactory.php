<?php

    use App\Models\MailTemplate;
    use App\Models\Template;
    use Faker\Generator as Faker;

    $factory->define(MailTemplate::class, function(Faker $faker) {
        return [
            'name'        => $faker->name,
            'template_id' => factory(Template::class)->create()->id,
        ];
    });
