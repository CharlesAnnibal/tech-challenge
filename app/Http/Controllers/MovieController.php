<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use App\Repositories\Movie\MovieCRUDRepository;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *  @param \Illuminate\Http\Request
     *  @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index(Request $request)
    {
        $movie = new MovieCRUDRepository(["request" => $request, "movie" => null]);
        return new ResourceCollection($movie->read());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MovieRequest  $request
     * @return \App\Http\Resources\Movie
     */
    public function store(MovieRequest $request)
    {
        $movie = new MovieCRUDRepository(["request" => $request]);
        $teste = $movie->create();
        return new \App\Http\Resources\Movie($teste);
    }

    /**
     * Display the specified resource.
     *
     * @param  Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return new \App\Http\Resources\Movie($movie);
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  Movie  $movie
     * @param  App\Http\Requests\MovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Movie $movie, MovieRequest $request)
    {
        $movie = new MovieCRUDRepository(["request" => $request, "movie" => $movie]);
        $updatedMovie = $movie->update();
        return new \App\Http\Resources\Movie($updatedMovie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie = new MovieCRUDRepository(["request" => null, "movie" => $movie]);
        $deletedMovie = $movie->delete();
        return new Response(["message" => "Movie " . $deletedMovie->name . " was deleted successfully"], 200);
    }
}
