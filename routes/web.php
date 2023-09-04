<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CharacterController::class, 'index'])->name('home');

//---------------------------------------------Characters--------------------------------------------------
Route::get('/characters/', function () {
    return redirect('/characters/page/1');
})->name('characters.all');

Route::get('/characters/page/{page}', [CharacterController::class, 'charactersPerPage'])->name('characters.page');

Route::get('/characters/{id}', [CharacterController::class, 'getSingleCharacter'])->name('character.single');

//---------------------------------------------Locations--------------------------------------------------
Route::group(['prefix' => '/location'], function () {
    Route::get('/', function () {
        return redirect('/location/page/1');
    })->name('location.all');
    Route::get('/page/{page}', [LocationController::class, 'locationPerPage'])->name('location.page');
    Route::get('/{id}/residents', [LocationController::class, 'residents'])->name('location.residents');
});

//---------------------------------------------Episodes--------------------------------------------------

Route::group(['prefix' => '/episode'], function () {
    Route::get('/', function() {
        return redirect('/episode/page/1');
    })->name('episodes.all');

    Route::get('/page/{page}', [EpisodeController::class, 'getEpisodesPerPage'])->name('episode.page');

    Route::get('/{id}/characters', [EpisodeController::class, 'getCharacters'])->name('episode.characters');
});

//---------------------------------------------------------------------------------------------------------

