<?php

use Faker\Generator as Faker;

$factory->define(Leroy\Models\Product::class, function (Faker $faker) {
    return [
        'lm'            =>  $faker->randomDigitNotNull(1000),
        'category'      =>  12312,
        'name'          =>  $faker->randomElement(
            [
                'Furadeira X',
                'Furadeira Y',
                'Chave de Fenda X',
                'Serra de Marmore',
                'Broca Z',
                'Luvas de Proteção',
            ]
        ),
        'free_shipping' =>  $faker->boolean,
        'description'   =>  $faker->randomElement(
            [
                'Furadeira X',
                'Furadeira Y',
                'Chave de Fenda X',
                'Serra de Marmore',
                'Broca Z',
                'Luvas de Proteção',
            ]),
        'price'         =>  $faker->randomFloat(2,0,300)
    ];
});
