<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
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

    public function getCharactersByPage($page)
    {
        return $this->fetchInfo('character?page=' . $page);
    }

    public function getAllLocations()
    {
        return $this->fetchInfo('location');
    }

    public function getLocationById($id)
    {
        return $this->fetchInfo('location/' . $id);
    }

    public function getLocationsByPage($page)
    {
        return $this->fetchInfo('location?page=' . $page);
    }

    public function getResidentsForLocation($locationId): array
    {
        $response = $this->fetchInfo('location/' . $locationId);
        return $response['residents'];
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

    public function fetchAPI($endpoint)
    {
        try {
            $response = Http::get($endpoint);
            $response->throw();

            return $response->json();
        } catch (RequestException $e) {
            //TODO: Handle request exception, e.g., log the error or return an error response.
            return [];
        }
    }

}
