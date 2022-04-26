<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Game_Play;

class RoomController extends Controller
{

    public function createWaitingRoom(Request $settings)
    {
        $data = $settings->validate([
            'name' => 'required|min:3"max:15'
        ]);
        $waitingRoom = \App\Models\Room::createRoom($data['name']);
        $this->joinToRoom($waitingRoom,session('userID'));
        $settings->session()->put('userRoom', $waitingRoom['id']);
        return redirect()->action(\App\Http\Livewire\Room::class,["idRoom"=>$waitingRoom['id']]);
    }

    public function getRoomView(Request $settings,$idRoom){
        $playerID= session('userID');
        $waitingRoom = \App\Models\Room::find($idRoom);
        $this->joinToRoom($waitingRoom,$playerID);
        $settings->session()->put('userRoom', $idRoom);
        return redirect()->action(\App\Http\Livewire\Room::class,["idRoom"=>$idRoom]);
    }

    private function joinToRoom($room, $playerID){
        $columns = $room->getColumnsNames();
        foreach($columns as $column)
            if($room[$column] == $playerID) return;

        $userID= session('userID');

        foreach($columns as $column){
            if($room[$column] == null) {
                $room->update([$column =>  $userID]);
                return;
            }
        }
    }

    public function removeUserFromQueue(Request $settings){
        $playerID= session('userID');
        $lobby = Room::find(intval(session('userRoom')));
        if($lobby!=null) {
            $lobby->removePlayer($playerID);
            $settings->session()->put('userRoom', null);
        }
    }

    public function createGame(Request $settings){
        $roomID= session('userRoom');
        $room = Room::find($roomID);
        $usersInRoom = $room->getUsers();
        $idArray = array();
        foreach($usersInRoom as $user){
            if($user!=null) $idArray[]= Player::createNewPlayer($user->id);
            else $idArray[] = null;
        }
        $gamePlayID = Game_Play::createGame($idArray);
        $room->gameStarted($gamePlayID);
    }


    public function kickUser($idRoom, $idPlayer){
        $lobby = Room::find(intval($idRoom));
        if ($lobby != null) $lobby->removePlayer(intval($idPlayer));
    }
}
