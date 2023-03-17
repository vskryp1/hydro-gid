<?php

    use App\Models\Product\Product;
    use App\Models\Product\ProductImage;
    use Faker\Generator as Faker;

    $factory->define(ProductImage::class, function(Faker $faker, $attr) {
        $dir = Product::GALLERY_PATH . $attr['product_id'] . '/';
        Storage::disk('public')->createDir($dir);
        $image = $faker->image(Storage::disk('public')->path($dir));
        $name  = basename($image);

        return [
            'cover'    => $faker->boolean,
            'image'    => $name,
            'position' => $faker->randomNumber(),
            'ru'       => [
                'alt'   => $faker->sentence(rand(1, 3)),
                'title' => $faker->sentence(rand(1, 3)),
            ],
        ];
    });
