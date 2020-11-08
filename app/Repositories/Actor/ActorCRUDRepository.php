<?php

namespace App\Repositories\Actor;

use App\Models\Actor;
use Illuminate\Http\Request;
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
        $this->actor = $options["actor"];
    }

    public function read()
    {
        $this->setGetAllBuilder(Actor::query());
        $this->setGetAllOrdering('name', 'desc');
        $this->parseRequestConditions($this->request);
        return $this->getAll()->paginate();
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
}
