<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class playersList extends Component
{
    public $players,$farm;

    public function mount($farm)
    {
        $this->farm= $farm;
        $this->players= $farm->getPlayers();
    }

    public function render()
    {
        $this->players= $this->farm->getPlayers();
        return view('livewire.players_list');
    }

}
