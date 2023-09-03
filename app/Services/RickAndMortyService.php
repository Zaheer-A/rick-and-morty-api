<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RickAndMortyService
{
    protected string $baseAPI = 'https://rickandmortyapi.com/api/';

    public function getAllCharacters()
    {
        return $this->fetchInfo('character');
    }

    public function getCharacterById($id)
    {
        return $this->fetchInfo('character/' . $id);
    }

    protected function fetchInfo($endpoint)
    {
        try {
            $response = Http::get($this->baseAPI . $endpoint);
            $response->throw();

            return $response->json();
        } catch (RequestException $e) {
            //TODO: Handle request exception, e.g., log the error or return an error response.
            return [];
        }
    }

}
