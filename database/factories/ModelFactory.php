<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Category;
use App\User;
use App\Book;
use App\Author;
use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(User::class, function (Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Category::class, function (Generator $faker) {

    $name = $faker->word;

    return [
        'name' => $name,
        'description' => $faker->paragraph,
        'img'  => "\\img\\placeholder-category.jpg",
        'slug' => $name
    ];

});

$factory->define(Author::class, function (Generator $faker) {

    return [
        'name' => $faker->name,
    ];
});

$factory->define(Book::class, function (Generator $faker) {

    $name = $faker->sentence(3);

    return [
        'title' => $name,
        'description' => $faker->paragraph,
        'slug' => $name,
        'published' => $faker->date(),
        'category_id' => function() {

            return factory(Category::class)->create()->id;

        },

        'author_id' => function() {

            return factory(Author::class)->create()->id;

        }

    ];
});