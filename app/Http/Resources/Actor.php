<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Actor extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'bio' => $this->bio,
            'born_at' => $this->born_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'filmography' => $this->filmography,
            'starred_as' => MovieRole::collection($this->roles)
        ];
    }
}
