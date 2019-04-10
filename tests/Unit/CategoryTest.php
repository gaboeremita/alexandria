<?php

namespace Tests\Unit;

use App\Book;
use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    protected $category;

    public function setUp()
    {
        parent::setUp();

        $this->category = create(Category::class);

    }

    /** @test */
    public function it_has_a_name()
    {
        $name = $this->category->name;

        $this->assertNotEmpty($name);

    }

    /** @test */
    public function it_has_a_description()
    {
        $description = $this->category->description;

        $this->assertNotEmpty($description);

    }

    /** @test */
    public function it_has_many_books()
    {

        $book = make(Book::class);

        $this->category->books()->save($book);

        $this->assertInstanceOf(Book::class, $this->category->books()->first());

    }
}
