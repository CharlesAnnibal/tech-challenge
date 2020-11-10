<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MovieRole\MovieRoleCRUDRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Requests\MovieRoleRequest;
use App\Models\MovieRole;
use Illuminate\Http\Response;

class MovieRoleController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     *  @param \Illuminate\Http\Request
     *  @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index(Request $request)
    {
        $movie = new MovieRoleCRUDRepository(["request" => $request, "movie" => null]);
        return new ResourceCollection($movie->read());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MovieRoleRequest  $request
     * @return \App\Http\Resources\MovieRole
     */
    public function store(MovieRoleRequest $request)
    {
        $movieRole = new MovieRoleCRUDRepository(["request" => $request]);
        return new \App\Http\Resources\MovieRole($movieRole->create());
    }


     /**
     * Display the specified resource.
     *
     * @param  MovieRole  $movieRole
     * @return \Illuminate\Http\Response
     */
    public function show(MovieRole $movieRole)
    {
        return new \App\Http\Resources\MovieRole($movieRole);
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  MovieRole  $movieRole
     * @param  App\Http\Requests\MovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRole $role, MovieRoleRequest $request)
    {
        $movieRole = new MovieRoleCRUDRepository(["request" => $request, "movieRole" => $role]);
        $updatedMovieRole = $movieRole->update();
        return new \App\Http\Resources\MovieRole($updatedMovieRole);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  MovieRole  $movieRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovieRole $role)
    {
        $movieRoleOperations = new MovieRoleCRUDRepository(["request" => null, "movieRole" => $role]);
        $deletedMovieRole = $movieRoleOperations->delete();
        return new Response(["message" => "Role " . $deletedMovieRole->name . " was deleted successfully"], 200);
    }
}
