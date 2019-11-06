<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {

	$title = $faker->unique()->randomElement($array = array ('art','literature','poetry', 'music'));

    return [
        'title' => $title,
        'slug' => str_slug($title)
    ];
});
