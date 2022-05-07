<?php

use App\Http\Livewire\Rooms_List;
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

//playerController
Route::get('/','App\Http\Controllers\UserController@getStartView');
Route::post('user','App\Http\Controllers\UserController@createUser');

//RoomController
Route::post('lobby/room','App\Http\Controllers\RoomController@createWaitingRoom');
Route::post('lobby/room/leave','App\Http\Controllers\RoomController@removeUserFromQueue');
Route::get('lobby/room/{idRoom}','App\Http\Controllers\RoomController@getRoomView');
Route::post('create-game','App\Http\Controllers\RoomController@createGame');

//RoomComponent
Route::get('lobby/room/joined/{idRoom}', App\Http\Livewire\Room::class)->middleware("LastUserActivity","isUserInRoom");
Route::get('lobby/list/rooms', App\Http\Livewire\AllRooms::class)->middleware("LastUserActivity");
Route::get('lobby/list', App\Http\Livewire\AllRooms::class)->middleware("LastUserActivity");

//UserInterfaceComponent
Route::get('game_play/{gameID}',App\Http\Livewire\UserInterface::class);
Route::post('game_play/play/again','App\Http\Controllers\gamePlayController@playAgain');

