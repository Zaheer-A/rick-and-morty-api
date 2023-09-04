<?php

namespace App\Http\Controllers;

use App\Services\RickAndMortyService;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{

    protected RickAndMortyService $rickAndMortyService;

    public function __construct(RickAndMortyService $rickAndMortyService)
    {
        $this->rickAndMortyService = $rickAndMortyService;
    }

    public function getEpisodesPerPage($page)
    {
        $episodeData = $this->rickAndMortyService->getEpisodePerPage($page);
        $maxPages = $episodeData['info']['pages'];
        $prevPage = ($page == 1) ? 1 : $page - 1;
        $nextPage = ($page == $maxPages) ?  1 : $page + 1;
        return view('episodes', ['episodes' => $episodeData['results'], 'info' => $episodeData['info'], 'prev' => $prevPage, 'next' => $nextPage]);
    }

    public function getSingleEpisode($id)
    {
        $episode = $this->rickAndMortyService->getEpisodeByID($id);
        return view('single.episode', ['episode' => $episode]);
    }

    public function getCharacters($episodeId)
    {
        $characterUrls = $this->rickAndMortyService->getCharactersForEpisode($episodeId);
        $episode = $this->rickAndMortyService->getEpisodeByID($episodeId);
        $characters = [];

        foreach ($characterUrls as $url)
        {
            $response = $this->rickAndMortyService->fetchAPI($url);
            $characters[] = $response;
        }

        return view('episodes_characters', ['characterCollection' => $characters, 'episode' => $episode]);
    }

}
