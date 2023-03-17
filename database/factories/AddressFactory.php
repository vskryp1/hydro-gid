<?php

    use App\Models\Client\Address;
    use App\Models\Region\Region;
    use Faker\Generator as Faker;

    $factory->define(Address::class, function(Faker $faker, $attr) {
        return [
            'client_id' => $attr['client_id'],
            'region_id' => $faker->boolean(10) ? Region::all()->random()->first()->id : null,
            'city'      => $faker->city,
            'street'    => $faker->streetName,
            'house'     => $faker->buildingNumber,
        ];
    });
