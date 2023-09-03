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
        $characters = new CharacterCollection(collect($charactersData));
        return new CharacterCollection(collect($characters));

    }

    public function single($id)
    {
        $character = $this->rickAndMortyService->getCharacterById($id);
        return $character;
    }
}
