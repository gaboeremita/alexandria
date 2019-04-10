<?php

use App\Book;
use App\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        foreach ($categories as $category) {

            factory(Book::class, 10)->create(['category_id' => $category->id]);

        }
    }
}
