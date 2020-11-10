<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieRole extends Model
{
    protected $fillable = ['name', 'actor_id', 'movie_id', 'created_at', 'updated_at'];

    /**
     * Get the movie that this role belongs to.
     */
    public function movie()
    {
        return $this->belongsTo('App\Models\Movie', 'foreign_key', 'movie_id');
    }

    /**
     * Get the actor that this role belongs to.
     */
    public function actor()
    {
        return $this->belongsTo('App\Models\Actor', 'foreign_key', 'movie_id');
    }
}
