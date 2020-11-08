<?php

namespace App\Repositories;

interface BaseCRUDRepository{

    public function read();
    public function create();
    public function update();
    public function delete();

}
