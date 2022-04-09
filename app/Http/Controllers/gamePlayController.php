<?php

namespace App\Http\Controllers;

use App\Models\Game_Play;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class gamePlayController extends Controller
{
    public function createGamePlay($playersID1,$playersID2, $playersID3,$playersID4,Request $request): \Illuminate\Http\RedirectResponse{
        $gamePlay = new \App\Models\Game_Play;
        $gamePlay->player_1 = (int)$playersID1;
        $gamePlay->player_2 = (int)$playersID2;
        if($playersID3 =='0') $gamePlay->player_3 = null;
        else $gamePlay->player_3 = strval($playersID3);
        if($playersID4 =='0') $gamePlay->player_4 = null;
        else $gamePlay->player_4 = strval($playersID4);
        $gamePlay->current_player = (int)$playersID1;
        $gamePlay->rabbits=60;
        $gamePlay->sheep=24;
        $gamePlay->pigs=20;
        $gamePlay->cows=12;
        $gamePlay->horses=6;
        $gamePlay->small_dogs=4;
        $gamePlay->big_dogs=2;
        $gamePlay->save();
        $request->session()->put('gamePlayID',$gamePlay->id);
        return redirect("lobby/pass/game_play/$gamePlay->id");
    }

    public function gamePlay(Request $request ,$id=0, $throw1 = 0, $throw2 = 0)
    {
        $game_playID = $request->session()->get('gamePlayID');
        if($game_playID == null) return redirect("lobby");
        $gamePlay = Game_Play::find($game_playID);
        $players = $this->getPlayers($game_playID);
        $checkIsWin=false;
        if($this->isWin(Player::find($gamePlay->current_player)))$checkIsWin=true;
        return View::make("layouts/game_play",["players"=> $players,"farm"=>$gamePlay,"currentPlayer"=>$this->getCurrentPlayerName($game_playID),
            'throw1'=>$throw1,'throw2'=>$throw2,
            'isWin'=>$checkIsWin
        ]);
    }

    public function getPlayers($game_playID): array{
        $game_play = Game_Play::find($game_playID);
        $players = array();
        array_push($players,Player::find($game_play->player_1));
        array_push($players,Player::find($game_play->player_2));
        if(Player::find($game_play->player_3)!=null) array_push($players,Player::find($game_play->player_3));
        if(Player::find($game_play->player_4)!=null) array_push($players,Player::find($game_play->player_4));
        return $players;
    }

    public function getCurrentPlayerName($id): string
    {
        $game_play = Game_Play::find($id);
        return Player::find($game_play->current_player)->name;
    }

    public function throwDice(Request $request)
    {
        $greenDice = array('wolf','rabbits','rabbits','rabbits','rabbits','rabbits','rabbits','sheep','sheep','sheep','pigs','cows');
        $redDice = array('fox','rabbits','rabbits','rabbits','rabbits','rabbits','rabbits','sheep','sheep','pigs','pigs','horses');
        $throw1 = $greenDice[rand(0,11)];
        $throw2 = $redDice[rand(0,11)];
        $throws = array($throw1,$throw2);

        $game_playID = $request->session()->get('gamePlayID');
        $game_play = Game_Play::find($game_playID);
        $player = Player::find($game_play->current_player);

        foreach($throws as $playerThrow){
            if ($this->isHaveAnimals($player)) {

                if ($playerThrow != 'fox' && $playerThrow != 'wolf') {
                    $this->getFromFarm($playerThrow,$player,$game_play);
                }

                if ($playerThrow == 'fox') {
                    if ($player->small_dogs > 0) {
                        $player->update(['small_dogs' =>  $game_play->small_dogs - 1]);
                        $game_play->update(['small_dogs' =>  $game_play->small_dogs +1]);
                    }
                    else {
                        $game_play->update(['rabbits' =>  $game_play->rabbits + $player->rabbits]);
                        $player->update(['rabbits' =>  0]);
                    }
                }

                if ($playerThrow == 'wolf') {
                    if ($player->big_dogs > 0) {
                        $player->update(['big_dogs' =>  $game_play->big_dogs - 1]);
                        $game_play->update(['big_dogs' =>  $game_play->big_dogs +1]);
                    }
                    else {
                        $game_play->update(['rabbits' =>  $game_play->rabbits + $player->rabbits]);
                        $game_play->update(['sheep' =>  $game_play->sheep + $player->sheep]);
                        $game_play->update(['pigs' =>  $game_play->pigs + $player->pigs]);
                        $game_play->update(['cows' =>  $game_play->cows + $player->cows]);
                        $player->update(['rabbits' =>  0]);
                        $player->update(['sheep' =>  0]);
                        $player->update(['pigs' =>  0]);
                        $player->update(['cows' =>  0]);
                    }
                }
                }
            else {
                if ($throw1 == $throw2) {
                    $player->update([$playerThrow => $player[$playerThrow] +1]);
                    $game_play->update([$playerThrow =>  $game_play[$playerThrow] - 1]);
                }
            }
        }
        $player->save();
        $game_play->save();
        $this->changePlayer($game_play);
        return redirect("lobby/pass/game_play/$game_playID/$throw1/$throw2");
    }

    private function getFromFarm($animal ,$player, $farm){
        $animalGetCount = round(($player[$animal] + 1) /2);

        if ($farm[$animal] >= $animalGetCount) {
            $player->update([$animal => $player[$animal]+$animalGetCount]);
            $farm->update([$animal => $farm[$animal]-$animalGetCount]);
        }
        else {
            $player->update([$animal => $player[$animal] + $farm[$animal]]);
            $farm->update([$animal => 0]);
        }
    }

    private function isHaveAnimals($player){
        if($player->rabbits == 0 && $player->sheep == 0 && $player->pigs == 0 &&
            $player->cows == 0 &&  $player->horses == 0) return false;
        return true;
    }

    private function isWin($player){
        if($player->rabbits > 0 && $player->sheep > 0 && $player->pigs > 0 &&
            $player->cows > 0 &&  $player->horses > 0) return true;
        return false;
    }


    private function changePlayer($game_play){
        $players = $this->getPlayers($game_play->id);
        $max = count($players) - 1;
        $nextPlayer=0;
        for($i=0;$i<=$max;$i++){
            if($game_play->current_player == $players[$i]['id']){
                $nextPlayer = ($game_play->current_player == $players[$max]['id'])? $players[0]['id'] : $players[$i+1]['id'];
                break;
            }
        }
        $game_play->update(["current_player" =>$nextPlayer]);
        $game_play->save();
    }

    public function trade(Request $settings){
        $game_playID = $settings->session()->get('gamePlayID');
        $game_play = Game_Play::find($game_playID);
        $player = Player::find($game_play->current_player);
        $animalToTrade = $settings->Input("animalToTrade");
        $forAnimal = $settings->Input("forAnimal");
        $number= (int)$settings->get('number');
        if($number>0) $this->sell($player,$game_play,$animalToTrade,$forAnimal,$number);
        else $this->buy($player,$game_play,$animalToTrade,$forAnimal,$number);

        return redirect("lobby/pass/game_play/$game_playID");
    }

    private function sell($player,$farm,$animalToTrade,$forAnimal,$number){
        if($farm[$forAnimal] - $number>=0 && $player[$forAnimal] + $number>=0 && $player[$animalToTrade] - 1>=0 ) {
            $player->update([$animalToTrade => $player[$animalToTrade] - 1]);
            $player->update([$forAnimal => $player[$forAnimal] + $number]);

            $farm->update([$animalToTrade => $farm[$animalToTrade] + 1]);
            $farm->update([$forAnimal => $farm[$forAnimal] - $number]);
        }
    }

    private function buy($player,$farm,$animalToTrade,$forAnimal,$number){
        if($player[$forAnimal] + 1>=0 && $player[$animalToTrade] + $number>=0 && $farm[$forAnimal] - 1>=0 && $farm[$animalToTrade] - $number>=0) {
            $player->update([$forAnimal => $player[$forAnimal] + 1]);
            $player->update([$animalToTrade => $player[$animalToTrade] + $number]);

            $farm->update([$forAnimal => $farm[$forAnimal] - 1]);
            $farm->update([$animalToTrade => $farm[$animalToTrade] - $number]);
        }
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
        return redirect("lobby/pass/game_play/$game_playID");
    }
}
