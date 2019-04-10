<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

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
     *  An author writes books
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wrote() {

        return $this->hasMany(Book::class);

    }
}
