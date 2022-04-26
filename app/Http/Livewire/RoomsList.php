<?php

namespace App\Http\Livewire;

use App\Http\Controllers\RoomController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class RoomsList extends Component
{
    public Collection $rooms;
    public function mount(){
        $this->rooms= \App\Models\Room::all();
    }

    public function render()
    {
        $this->rooms= \App\Models\Room::all();
        return view('livewire.rooms_list')->layout("layouts.user_rooms");
    }

    public function redirectToRoom($id)
    {

        return redirect()->action('\App\Http\Controllers\RoomController@getRoomView',["idRoom"=>$id]);
    }

}
