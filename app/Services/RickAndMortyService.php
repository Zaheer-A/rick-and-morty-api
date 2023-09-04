<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RickAndMortyService
{

    protected string $baseAPI = 'https://rickandmortyapi.com/api/';

    public function getCharacterById($id)
    {
        return $this->fetchInfo('character/' . $id);
    }

    public function getCharactersByPage($page)
    {
        return $this->fetchInfo('character?page=' . $page);
    }

    public function getEpisodesOfCharacter($characterId)
    {
        $response =  $this->fetchInfo('character/'. $characterId);
        return $response['episode'];
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

    public function getEpisodeByID($id)
    {
        return $this->fetchInfo('episode/' . $id);
    }

    public function getEpisodePerPage($page)
    {
        return $this->fetchInfo('episode?page=' . $page);
    }



    public function getCharactersForEpisode($episodeId): array
    {
        $response = $this->fetchInfo('episode/' . $episodeId);
        return $response['characters'];
    }



    protected function fetchInfo($endpoint)
    {
        try {
            $response = Http::get($this->baseAPI . $endpoint);
            $response->throw();

            return $response->json();
        } catch (RequestException $e) {
            return Response::HTTP_INTERNAL_SERVER_ERROR;
        }
    }

    public function fetchAPI($endpoint)
    {
        try {
            $response = Http::get($endpoint);
            $response->throw();

            return $response->json();
        } catch (RequestException $e) {
            return Response::HTTP_INTERNAL_SERVER_ERROR;
        }
    }

}
