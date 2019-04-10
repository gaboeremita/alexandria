<?php

use App\Category;
use Illuminate\Database\Seeder;
use Faker\Generator;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory('App\Category', 5)->create();

    }
}
