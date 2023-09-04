<?php

namespace App\Http\Controllers;

use App\Services\RickAndMortyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

class LocationController extends Controller
{
    protected RickAndMortyService $rickAndMortyService;

    public function __construct(RickAndMortyService $rickAndMortyService)
    {
        $this->rickAndMortyService = $rickAndMortyService;
    }

    public function locationPerPage($page)
    {
        $locationData = $this->rickAndMortyService->getLocationsByPage($page);
        $locations = $locationData['results'];
        $maxPages = $locationData['info']['pages'];
        $prevPage = ($page == 1) ? 1 : $page - 1;
        $nextPage = ($page == $maxPages) ?  1 : $page + 1;

        return view('locations', ['locations' => $locations, 'prevPage' => $prevPage, 'nextPage' => $nextPage]);
    }

    public function residents($locationId)
    {
        $residentsUrls = $this->rickAndMortyService->getResidentsForLocation($locationId);
        $location = $this->rickAndMortyService->getLocationById($locationId);
        $characters = [];

        foreach ($residentsUrls as $url)
        {
            $response = $this->rickAndMortyService->fetchAPI($url);
            $characters[] = $response;
        }

        return view('residents', ['characters' => $characters, 'locationName' => $location['name']]);
    }
}
