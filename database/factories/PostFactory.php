<?php
namespace Database\Factories;


/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
namespace Database\Factories;
class PostFactory extends Factory
{

    public function definition(): array
    {

        return [
            'user_id' => 1,
            'caption' => $faker->sentence(),
            'image_path' => '/app-images/placeholders/'.strval(rand(1, 10)).'.jpg',
        ];


    }
}
