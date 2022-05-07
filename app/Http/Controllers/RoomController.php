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
        $isJoined= $this->joinToRoom($waitingRoom,$playerID);
        if($isJoined) {
            $settings->session()->put('userRoom', $idRoom);
            return redirect()->action(\App\Http\Livewire\Room::class,["idRoom"=>$idRoom]);
        }
        return $this->redirectToGame($playerID,$idRoom);
    }

    private function joinToRoom($room, $playerID){
        if(!$room->game_started) {
            $columns = $room->getColumnsNames();
            foreach ($columns as $column)
                if ($room[$column] == $playerID) return true;

            $userID = session('userID');

            foreach ($columns as $column) {
                if ($room[$column] == null) {
                    $room->update([$column => $userID]);
                    return true;
                }
            }
        }
        return false;
    }

    private function redirectToGame($playerID , $roomID){
        $lobby = \App\Models\Room::find($roomID);
        if($lobby!=null){
            if($lobby->isInRoom($playerID) == false) return redirect('lobby/list');
            if ($lobby->game_started == 1 && $lobby->isInRoom($playerID) == true) {
                return redirect()->action(\App\Http\Livewire\UserInterface::class, ["gameID" => $lobby->game_play_id]);
            }}
        else return redirect('lobby/list');
    }


    public function removeUserFromQueue(Request $settings){
        $playerID= session('userID');
        $lobby = Room::find(intval(session('userRoom')));
        if($lobby!=null) {
            if(!$lobby->game_started) {
                $lobby->removePlayer($playerID);
                $settings->session()->put('userRoom', null);
            }
        }
    }

    private function CountUsers($usersInRoom){
        $count=0;
        foreach($usersInRoom as $user) {
            if($user->name!=null) $count++;
        }
        return $count;
    }

    public function createGame(Request $settings){
        $roomID= session('userRoom');
        $room = Room::find($roomID);
        $usersInRoom = $room->getUsers();
        if($this->CountUsers($usersInRoom)<2)  return redirect()->action(\App\Http\Livewire\Room::class,["idRoom"=>$roomID]);
        $idArray = array();
        foreach($usersInRoom as $user){
            if($user->name!=null) $idArray[]= Player::createNewPlayer($user->id);
            else $idArray[] = null;
        }
        $gamePlayID = Game_Play::createGame($idArray);
        $room->gameStarted($gamePlayID);
        return redirect()->action(\App\Http\Livewire\UserInterface::class,["gameID"=>$gamePlayID]);
    }


    public function kickUser($idRoom, $idPlayer){
        $lobby = Room::find(intval($idRoom));
        if ($lobby != null) $lobby->removePlayer(intval($idPlayer));
    }
}
