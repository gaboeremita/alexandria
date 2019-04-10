<?php

namespace Tests\Unit;

use App\Author;
use App\Book;
use App\Category;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BookTest extends TestCase
{

    use DatabaseMigrations;

    protected $book;

    public function setUp()
    {
        parent::setUp();

        $this->book = create(Book::class);

    }

    /** @test */
    public function it_has_a_title()
    {
        $title = $this->book->title;

        $this->assertNotEmpty($title);

    }

    /** @test */
    public function it_has_an_author()
    {

        $this->assertInstanceOf(Author::class, $this->book->author);

    }

    /** @test */
    public function it_has_a_category()
    {

        $this->assertInstanceOf(Category::class, $this->book->category);

    }

    /** @test */
    public function it_has_a_published_date()
    {
        $published = $this->book->published;

        $this->assertNotEmpty($published);

    }

    /** @test */
    public function it_can_be_borrowed_by_an_user()
    {

        $user = create(User::class);

        $this->book->borrowedBy()->associate($user);

        $this->book->save();

        $this->assertInstanceOf(User::class, $this->book->borrowedBy);

    }

}
