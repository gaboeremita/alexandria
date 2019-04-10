<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    /**
     * Get a string path for the book.
     *
     * @return string
     */
    public function path()
    {
        return "/books/{$this->slug}";
    }


    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Create slug from name
     *
     * @param string $value
     *
     * @return void
     */
    public function setSlugAttribute($value) {

        $value = str_replace(' ', '_', $value);

        $this->attributes['slug'] = strtolower($value);

    }

    /**
     *  A book is written by an author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author() {

        return $this->belongsTo(Author::class);

    }

    /**
     * A book belongs to a category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {

        return $this->belongsTo(Category::class);

    }

    /**
     * A book can be borrowed by an user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function borrowedBy() {

        return $this->belongsTo(User::class, 'borrowed_by');

    }

}
