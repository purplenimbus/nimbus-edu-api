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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'fname' => $faker->name,
        'lname' => $faker->name
    ];
});

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->text(200)
    ];
});

$factory->define(App\Registration::class, function (Faker\Generator $faker) {
    return [
        //'description' => $faker->text(200)
    ];
});

$factory->define(App\Scores::class, function (Faker\Generator $faker) {
	
    return  [
			'quiz' => $faker->numberBetween(0,15),
			'midterm' => $faker->numberBetween(0,30),
			'assignment' => $faker->numberBetween(0,15),
			'lab' => $faker->numberBetween(0,5),
			'exam' => $faker->numberBetween(0,35)
		];
});

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
	
    return  [
			'title' => $faker->sentence(6,true),
			'description' => $faker->text(200),
			'content' => $faker->paragraphs(3,true)
		];
});
