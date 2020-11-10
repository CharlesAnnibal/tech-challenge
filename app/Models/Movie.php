<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'name', 'year', 'synopsis', 'runtime', 'released_at', 'cost', 'genre_id', 'created_at', 'updated_at'
    ];

    /**
     * The actors that belong to the movie.
     */
    public function actors()
    {
        return $this->belongsToMany('App\Models\Actor', 'movie_roles');
    }

    /**
     * The genre of the movie.
     */
    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }
}
