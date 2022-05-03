<?php

namespace App\Http\Livewire;

use App\Http\Controllers\RoomController;
use Livewire\Component;

class Room extends Component
{
    public $users;
    public $idRoom;
    public $isOwnerRoom;
    public $currentUser;
    private $room;

    public function mount($idRoom){
        $this->idRoom = $idRoom;
        $this->isOwnerRoom = false;
        $this->currentUser = session('userID');
    }

    public function render(){
        $this->users = $this->getUsers($this->idRoom);
        if($this->users == null) redirect()->action(AllRooms::class);
        if($this->users[0]['id'] == $this->currentUser) $this->isOwnerRoom = true;
        else $this->isOwnerRoom=false;
        return view('livewire.room')->layout("layouts.room",["idRoom"=>$this->idRoom]);
    }

    public function dehydrate(){
        foreach($this->users as $user){
            if($user['id']==$this->currentUser) return;
        }
        return redirect('lobby/list');
    }

    public function removeUser($id=null){
        if($id!=null)
        RoomController::kickUser($this->idRoom,$id);
    }

    public function leaveRoom($id){
        RoomController::kickUser($this->idRoom,$id);
        $this->emit('refreshProducts');
        return redirect('lobby/list');
    }


    private function getUsers($game_playID): array{
        $this->room =  \App\Models\Room::find($game_playID);
        if($this->room == null) return array();
        return $this->room->getUsers();
    }


}
