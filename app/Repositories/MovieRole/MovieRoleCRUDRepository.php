<?php

namespace App\Repositories\MovieRole;

use App\Models\MovieRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\HasFetchAllRenderCapabilities;
use App\Repositories\BaseCRUDRepository;

class MovieRoleCRUDRepository implements BaseCRUDRepository
{

    use HasFetchAllRenderCapabilities;

    protected $movieRole;
    protected $request;
    function __construct($options)
    {
        $this->request = $options["request"];
        $this->movieRole = empty($options["movieRole"]) ? null : $options["movieRole"];
    }

    public function read()
    {
        $this->setGetAllBuilder(MovieRole::query());
        $this->setGetAllOrdering('name', 'desc');
        $this->parseRequestConditions($this->request);
        return $this->getAll()->paginate();
    }

    public function create()
    {
        $movieRole = new MovieRole($this->request->validated());
        $movieRole->save();
        return $movieRole;
    }

    public function update()
    {
        $this->movieRole->fill($this->request->validated());
        $this->movieRole->save();
        return $this->movieRole;
    }

    public function delete()
    {
        $deletedMovie = $this->movieRole;
        $this->movieRole->delete();
        return $deletedMovie;
    }
}
