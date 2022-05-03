<?php

namespace App\Http\Livewire;

use App\Models\Game_Play;
use Livewire\Component;

class PlayerInfo extends Component
{
    public $idGame,$playerName;

    public function mount($farm){
        $this->idGame=$farm->id;
    }

    public function render()
    {
        $gamePlay= Game_Play::find($this->idGame);
        $this->playerName= $gamePlay->getCurrentPlayer()->getPlayerName();
        return view('livewire.player-info');
    }
}
