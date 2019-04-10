<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{

    /**
     * BooksController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $books = Book::paginate(10);

        return view('books.index', compact('books'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();

        $categoriesJSON = (string) $categories;

        $categoriesJSONPlucked =  (string) $categories->pluck("img", "name");

        $authors = Author::all();

        return view('books.create', compact( 'categories', 'authors', 'categoriesJSON', 'categoriesJSONPlucked'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'description' => 'required',
            'published' => 'required|date',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Book::create([
            'title' => $request->title,
            'slug' => $request->title,
            'description' => $request->description,
            'published' => (new Carbon($request->published)),
            'author_id' => $request->author_id,
            'category_id' => $request->category_id
        ]);

        session()->flash('message', 'A new book has added to the library!');

        return redirect('/books');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {

        return view('books.show', compact('book'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::all();

        $categoriesJSON = (string) $categories;

        $categoriesJSONPlucked =  (string) $categories->pluck("img", "name");

        $authors = Author::all();

        return view('books.edit', compact('book', 'categoriesJSONPlucked', 'categoriesJSON', 'authors'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'description' => 'required',
            'published' => 'required|date',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book->update([
            'title' => $request->title,
            'slug' => $request->title,
            'description' => $request->description,
            'published' => (new Carbon($request->published)),
            'author_id' => $request->author_id,
            'category_id' => $request->category_id
        ]);

        session()->flash('message', 'The book has been updated!');

        return redirect('/books');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {

            $book->delete();

            $message = 'The book has been deleted!';


        } catch (Exception $e) {

            $message = 'We\'re sorry. The book could not be deleted.';

        }

        session()->flash('message', $message);

        return redirect('/books');
    }

    /**
     * Feeder for Vue component table
     *
     * @param Request $request
     * @return array
     */
    public function bookFeeder(Request $request) {

        $columns = ['title', 'description', 'published', 'author', 'category'];

        $length = 10;
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = DB::table('books')
                        ->select('books.id', 'books.description', 'books.title',
                            'books.published', 'books.slug', 'authors.name as author',
                            'categories.name as category')
                        ->join('authors', 'books.author_id', '=', 'authors.id')
                        ->join('categories', 'books.category_id', '=', 'categories.id')
                        ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('title', 'like', '%' . $searchValue . '%');
            });
        }

        $books = $query->paginate($length);
        return ['data' => $books, 'draw' => $request->input('draw')];

    }

    /**
     * Lend a book to a specific user
     *
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function borrow(Book $book)
    {

        $book->update(['borrowed_by' => auth()->id()]);

        session()->flash('message', 'Done! Please take care of it');

        return redirect('/books');

    }

}
