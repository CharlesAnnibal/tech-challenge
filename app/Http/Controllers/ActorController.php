<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\HasFetchAllRenderCapabilities;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Requests\ActorRequest;
use App\Models\Actor;
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
        $this->setGetAllBuilder(Actor::query());
        $this->setGetAllOrdering('name', 'desc');
        $this->parseRequestConditions($request);
        return new ResourceCollection($this->getAll()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ActorRequest  $request
     * @return \App\Http\Resources\Actor
     */
    public function store(ActorRequest $request)
    {
        $actor = new Actor($request->validated());
        $actor->save();
        return new \App\Http\Resources\Actor($actor);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Actor $actor, ActorRequest $request)
    {
        $actor->fill($request->validated());
        $actor->save();

        return new \App\Http\Resources\Actor($actor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        $deletedActorName = $actor->name;
        $actor->delete();
        return new Response(["message"=>"Actor ".$deletedActorName." was deleted successfully"], 200);
    }
}
