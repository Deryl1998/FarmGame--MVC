<?php

namespace App\Http\Controllers;

use App\Models\Game_Play;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class gamePlayController extends Controller
{

    public function gamePlay(Request $request)
    {
        $game_playID = $request->session()->get('gamePlayID');
        if($game_playID == null) return redirect("lobby");
        //$throw1 = session('throw1');
        //$throw2 = session('throw2');
        //$this->setSessionGame(0,0);
       // $gamePlay = Game_Play::find($game_playID);
       // $round = $this->isPlayerRound($gamePlay->current_player);
        //$players = $this->getPlayers($game_playID);
        $checkIsWin=false;

        return View::make("layouts/game_play",["players"=> $players,"farm"=>$gamePlay,"currentPlayer"=>$this->getCurrentPlayerName($game_playID),
            'throw1'=>$throw1,'throw2'=>$throw2,
            'isWin'=>$checkIsWin,
            'endRound'=> !$round
        ]);
    }


    public function getCurrentPlayerName($id): string
    {
        $game_play = Game_Play::find($id);
        return Player::find($game_play->current_player)->getPlayerName();
    }

    public function playAgain(Request $settings){
        $game_playID = $settings->session()->get('gamePlayID');
        $gamePlay = Game_Play::find($game_playID);
        $players = $this->getPlayers($game_playID);
        $gamePlay->current_player = $players[0]['id'];
        $gamePlay->rabbits=60;
        $gamePlay->sheep=24;
        $gamePlay->pigs=20;
        $gamePlay->cows=12;
        $gamePlay->horses=6;
        $gamePlay->small_dogs=4;
        $gamePlay->big_dogs=2;
        $gamePlay->save();
        foreach ($players as $player){
            $player->rabbits = 0;
            $player->sheep = 0;
            $player->pigs = 0;
            $player->cows = 0;
            $player->horses = 0;
            $player->small_dogs = 0;
            $player->big_dogs = 0;
            $player->save();
        }
        return redirect('game_play');
    }
}
