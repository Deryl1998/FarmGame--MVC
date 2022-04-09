<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('lobby');
});

Route::get('lobby/','App\Http\Controllers\LobbyController@getLobbyView');
Route::post('lobby/pass','App\Http\Controllers\LobbyController@getLobbyForm');
Route::get('lobby/pass/game_play/{playersID1}/{playersID2}/{playersID3}/{playersID4}','App\Http\Controllers\gamePlayController@createGamePlay');
Route::get('lobby/pass/game_play/{gameID}','App\Http\Controllers\gamePlayController@gamePlay');
Route::get('throw','App\Http\Controllers\gamePlayController@throwDice');
Route::get('lobby/pass/game_play/{gameID}/{throw1}/{throw2}','App\Http\Controllers\gamePlayController@gamePlay');
Route::post('lobby/pass/game_play/trade','App\Http\Controllers\gamePlayController@trade');
Route::post('lobby/pass/game_play/play/again','App\Http\Controllers\gamePlayController@playAgain');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

