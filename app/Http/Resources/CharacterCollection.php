<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class CharacterCollection extends ResourceCollection
{
    public function toResponse($request)
    {
        return (new Response(['data' => $this->collection]));
    }
}
