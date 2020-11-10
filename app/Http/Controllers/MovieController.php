<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return new \App\Http\Resources\MovieCollection($movie->read());
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
        return new \App\Http\Resources\Movie($movie->create());
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
     * @param  Movie  $movieFromRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movieOperations = new MovieCRUDRepository(["request" => null, "movie" => $movie]);
        $deletedMovie = $movieOperations->delete();
        return new Response(["message" => "Movie " . $deletedMovie->name . " was deleted successfully"], 200);
    }
}
