<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'data' => [
                'id' => $this->getId(),
                'name' => $this->getName(),
                'status' => $this->getStatus(),
                'species' => $this->getSpecies(),
                'gender' => $this->getGender(),
                'origin' => $this->getOrigin(),
                'location' => $this->getLocation(),
                'image' => $this->getImage(),
                'episodes' => $this->getEpisodes(),
                'url' => $this->getUrl()
            ]

        ];
    }
}
