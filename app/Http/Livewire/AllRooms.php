<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class AllRooms extends Component
{
    public Collection $rooms;
    public function mount(){
        $this->rooms= \App\Models\Room::all();
    }

    public function render()
    {
        $this->rooms= \App\Models\Room::all();
        return view('livewire.all-rooms')->layout("layouts.user_rooms");
    }

    public function redirectToRoom($id)
    {

        return redirect()->action('\App\Http\Controllers\RoomController@getRoomView',["idRoom"=>$id]);
    }
}
