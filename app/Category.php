<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

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
     * Categories can have many books
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books() {
        
        return $this->hasMany(Book::class);
        
    }
}
