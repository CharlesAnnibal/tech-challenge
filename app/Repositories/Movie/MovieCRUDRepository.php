<?php

namespace App\Repositories\Movie;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\HasFetchAllRenderCapabilities;
use App\Repositories\BaseCRUDRepository;

class MovieCRUDRepository implements BaseCRUDRepository
{

    use HasFetchAllRenderCapabilities;

    protected $movie;
    protected $request;
    function __construct($options)
    {
        $this->request = $options["request"];
        $this->movie = empty($options["movie"]) ? null : $options["movie"];
    }

    public function read()
    {
        $this->setGetAllBuilder(Movie::query());
        $this->setGetAllOrdering('name', 'desc');
        $this->parseRequestConditions($this->request);
        return $this->getAll()->paginate();
    }

    public function create()
    {
        $movie = new Movie($this->request->validated());
        $movie->save();
        return $movie;
    }

    public function update()
    {
        $this->movie->fill($this->request->validated());
        $this->movie->save();
        return $this->movie;
    }

    public function delete()
    {
        $deletedMovie = $this->movie;
        $this->movie->delete();
        return $deletedMovie;
    }
}
