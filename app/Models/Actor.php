<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['name', 'bio', 'born_at', 'created_at', 'updated_at'];

    /**
     * The movies that belongs to actor's filmography.
     */
    public function roles()
    {
        return $this->hasMany('App\Models\MovieRole');
    }

    public function filmography()
    {
        return $this->belongsToMany('App\Models\Movie', 'movie_roles', 'actor_id', 'movie_id')->distinct();
    }
}
