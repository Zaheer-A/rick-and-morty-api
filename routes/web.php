<?php

use App\Http\Controllers\CharacterController;
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
Route::get('/characters/', [CharacterController::class, 'allCharacters'])->name('characters.all');
Route::get('/characters/{id}', [CharacterController::class, 'single'])->name('character.single');

//---------------------------------------------------------------------------------------------------------

//---------------------------------------------Dimensions--------------------------------------------------

//---------------------------------------------------------------------------------------------------------

//---------------------------------------------Locations--------------------------------------------------

//---------------------------------------------------------------------------------------------------------

//---------------------------------------------Episodes--------------------------------------------------

//---------------------------------------------------------------------------------------------------------

