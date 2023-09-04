<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterCollection;
use App\Http\Resources\CharacterResource;
use App\Services\RickAndMortyService;
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

    public function allCharacters()
    {
        $charactersData = $this->rickAndMortyService->getAllCharacters();
        return view('characters', ['characterCollection' => $charactersData['results'], 'info' => $charactersData['info']]);
    }

    public function charactersPerPage($page)
    {
        $charactersData = $this->rickAndMortyService->getCharactersByPage($page);
        $maxPages = $charactersData['info']['pages'];
        $prevPage = ($page == 1) ? 1 : $page - 1;
        $nextPage = ($page == $maxPages) ?  1 : $page + 1;
        return view('characters', ['characterCollection' => $charactersData['results'], 'info' => $charactersData['info'], 'prev' => $prevPage, 'next' => $nextPage]);
    }

    public function single($id)
    {
        $character = $this->rickAndMortyService->getCharacterById($id);
        return view('single', ['character' => $character]);
    }
}
