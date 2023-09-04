<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterCollection;
use App\Http\Resources\CharacterResource;
use App\Services\RickAndMortyService;
use Illuminate\Support\Facades\Cache;
use function Laravel\Prompts\text;

class CharacterController extends Controller
{
    protected RickAndMortyService $rickAndMortyService;

    public function __construct(RickAndMortyService $rickAndMortyService)
    {
        $this->rickAndMortyService = $rickAndMortyService;
    }

    public function index()
    {
        return view('welcome');
    }

    public function charactersPerPage($page)
    {
        $charactersData = $this->rickAndMortyService->getCharactersByPage($page);
        $maxPages = $charactersData['info']['pages'];
        $prevPage = ($page == 1) ? 1 : $page - 1;
        $nextPage = ($page == $maxPages) ?  1 : $page + 1;
        return view('characters', ['characterCollection' => $charactersData['results'], 'info' => $charactersData['info'], 'prev' => $prevPage, 'next' => $nextPage]);
    }

    public function getSingleCharacter($id)
    {
        $character = $this->rickAndMortyService->getCharacterById($id);
        $episodes = Cache::remember('character_episodes_' . $id, 3, function () use ($id) {
            $episodesURLs = $this->rickAndMortyService->getEpisodesOfCharacter($id);
            $episodes = [];
            foreach ($episodesURLs as $url)
            {
                $response = $this->rickAndMortyService->fetchAPI($url);
                $episodes[] = $response;
            }
            return $episodes;
        });

        return view('single', ['character' => $character, 'episodes' => $episodes]);
    }
}
