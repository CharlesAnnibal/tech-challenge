<?php

namespace App\Repositories\Actor;

use App\Models\Actor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\HasFetchAllRenderCapabilities;
use App\Repositories\BaseCRUDRepository;

class ActorCRUDRepository implements BaseCRUDRepository
{

    use HasFetchAllRenderCapabilities;

    protected $actor;
    protected $request;
    function __construct($options)
    {
        $this->request = $options["request"];
        $this->actor = empty($options["actor"]) ? null : $options["actor"];
    }

    public function read()
    {
        $this->setGetAllBuilder(Actor::query());
        $this->setGetAllOrdering('name', 'desc');
        $this->parseRequestConditions($this->request);
        $paginator = $this->getAll()->paginate();
        $paginator->getCollection()->transform(function ($actor) {
            return self::addFavoriteGenre($actor);
        });
        return $paginator;
    }

    public function create()
    {
        $actor = new Actor($this->request->validated());
        $actor->save();
        return $actor;
    }

    public function update()
    {
        $this->actor->fill($this->request->validated());
        $this->actor->save();
        return $this->actor;
    }

    public function delete()
    {
        $deletedActor = $this->actor;
        $this->actor->delete();
        return $deletedActor;
    }

    public static function addFavoriteGenre(Actor $actor)
    {
        $genre = DB::table('genres')
            ->join('movies', 'genres.id', '=', 'movies.genre_id')
            ->join('movie_roles', 'movie_roles.movie_id', '=', 'movies.id')
            ->select(DB::raw('genres.name AS favorite_genre, COUNT(genres.name) AS `genre_occurrence`'))
            ->where('movie_roles.actor_id', '=', 1)
            ->groupBy('genres.name')
            ->orderBy('genre_occurrence', 'desc')
            ->limit(1)
            ->first();
        $actor->favorite_genre = $genre->favorite_genre;
        return $actor;
    }
}
