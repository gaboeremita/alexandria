<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user', compact('user'));
    }


    /**
     * Makes user to return a borrowed book
     *
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function returnBook(Book $book) {

        $book->borrowedBy()->dissociate();

        $book->save();

        session()->flash('message', 'Thank you!');

        return back();

    }

}
