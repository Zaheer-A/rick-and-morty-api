<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class CharacterCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($character) {
            return new CharacterResource($character);
        })->toArray();
    }
}
