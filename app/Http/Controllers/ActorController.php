<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\HasFetchAllRenderCapabilities;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Requests\ActorRequest;
use App\Models\Actor;
use App\Repositories\Actor\ActorCRUDRepository;
use Illuminate\Http\Response;

class ActorController extends Controller
{
    use HasFetchAllRenderCapabilities;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index(Request $request)
    {
        $actor = new ActorCRUDRepository(["request" => $request, "actor" => null]);
        return new ResourceCollection($actor->read());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ActorRequest  $request
     * @return \App\Http\Resources\Actor
     */
    public function store(ActorRequest $request)
    {
        $actor = new ActorCRUDRepository(["request" => $request, "actor" => null]);
        return new \App\Http\Resources\Actor($actor->create());
    }

    /**
     * Display the specified resource.
     *
     * @param  Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        return new \App\Http\Resources\Actor($actor);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Actor  $actor
     * @param  App\Http\Requests\ActorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Actor $actor, ActorRequest $request)
    {
        $actor = new ActorCRUDRepository(["request" => $request, "actor" => $actor]);
        $updatedActor = $actor->update();
        return new \App\Http\Resources\Actor($updatedActor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        $actor = new ActorCRUDRepository(["request" => null, "actor" => $actor]);
        $deletedActor = $actor->delete();
        return new Response(["message" => "Actor " . $deletedActor->name . " was deleted successfully"], 200);
    }
}
