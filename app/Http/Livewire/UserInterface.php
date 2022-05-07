<?php

namespace App\Http\Livewire;

use App\Models\Game_Play;
use App\Models\GameRules;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class UserInterface extends Component
{
    //Interface display
    public ?string $throw1 = null;
    public ?string $throw2 = null;
    public $endRound = false;
    public $playerPickToTrade = false;
    public $handelMenu = false;
    public $endGame=false;
    public $gameID;
    public $currentPlayerName;
    public $currentAnimal;
    //handel
    public $animalToTrade;
    public $forAnimal;
    public $count;

    public function mount($gameID){
        $this->gameID = $gameID;
    }

    public function render()
    {
        $gamePlay = Game_Play::find($this->gameID);
        $playerID = session('userID');
        $this->checkPlayerRound($playerID);
        $this->currentPlayerName = $gamePlay->getCurrentPlayer()->getPlayerName();
        if(Player::find($gamePlay->current_player)->isWin()) $this->endGame();
        return view('livewire.user_interface')->layout("layouts.game_play",["farm"=>$gamePlay,"gameID"=>$this->gameID]);
    }

    public function getRoles(){
        return $this->gameRules;
    }

    public function changePlayer(){
        $gamePlay = Game_Play::find($this->gameID);
        $gamePlay->changePlayer();
        $this->endRound = false;
        $this->playerPickToTrade = false;
        $this->handelMenu = false;
    }

    public function throwDice()
    {
            $greenDice = array('wolf', 'rabbits', 'wolf', 'rabbits', 'rabbits', 'rabbits', 'rabbits', 'sheep', 'sheep', 'sheep', 'pigs', 'cows');
            $redDice = array('fox', 'rabbits', 'fox', 'rabbits', 'fox', 'rabbits', 'rabbits', 'sheep', 'sheep', 'pigs', 'pigs', 'horses');
            $throw1 = $greenDice[rand(0, 11)];
            $throw2 = $redDice[rand(0, 11)];
            $throws = array($throw1, $throw2);

            $game_play = Game_Play::find($this->gameID);
            $player = Player::find($game_play->current_player);

            foreach ($throws as $playerThrow) {
                if ($player->isHaveAnimals()) {

                    if ($playerThrow != 'fox' && $playerThrow != 'wolf') {
                        $this->getFromFarm($playerThrow, $player, $game_play);
                    }

                    if ($playerThrow == 'fox') {
                        if ($player->small_dogs > 0) {
                            $player->update(['small_dogs' => $game_play->small_dogs - 1]);
                            $game_play->update(['small_dogs' => $game_play->small_dogs + 1]);
                        } else {
                            $game_play->update(['rabbits' => $game_play->rabbits + $player->rabbits]);
                            $player->update(['rabbits' => 0]);
                        }
                    }

                    if ($playerThrow == 'wolf') {
                        if ($player->big_dogs > 0) {
                            $player->update(['big_dogs' => $game_play->big_dogs - 1]);
                            $game_play->update(['big_dogs' => $game_play->big_dogs + 1]);
                        } else {
                            $game_play->update(['rabbits' => $game_play->rabbits + $player->rabbits]);
                            $game_play->update(['sheep' => $game_play->sheep + $player->sheep]);
                            $game_play->update(['pigs' => $game_play->pigs + $player->pigs]);
                            $game_play->update(['cows' => $game_play->cows + $player->cows]);
                            $player->update(['rabbits' => 0]);
                            $player->update(['sheep' => 0]);
                            $player->update(['pigs' => 0]);
                            $player->update(['cows' => 0]);
                        }
                    }
                } else {
                    if ($throw1 == $throw2) {
                        $player->update([$playerThrow => $player[$playerThrow] + 1]);
                        $game_play->update([$playerThrow => $game_play[$playerThrow] - 1]);
                    }
                }
            }
            $player->save();
            $game_play->save();
            $this->throw1 = $throw1;
            $this->throw2 = $throw2;
            $this->changePlayer();
    }

    // Give player animal drop and take from farm
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

    public function trade($animalToTrade,$forAnimal,$count){
        $game_play = Game_Play::find($this->gameID);
        $player = Player::find($game_play->current_player);
        if($count>0) $this->sell($player,$game_play,$animalToTrade,$forAnimal,$count);
        else $this->buy($player,$game_play,$animalToTrade,$forAnimal,$count);
        $this->pickToTradeHidden();
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


    public function playAgain(){
        $gamePlay = Game_Play::find($this->gameID);
        $players = $gamePlay->getPlayers();
        $gamePlay->current_player = $players[0]['id'];
        $gamePlay->rabbits=60;
        $gamePlay->sheep=24;
        $gamePlay->pigs=20;
        $gamePlay->cows=12;
        $gamePlay->horses=6;
        $gamePlay->small_dogs=4;
        $gamePlay->big_dogs=2;
        $gamePlay->save();
        $firstPlayer = true;
        foreach ($players as $player){
            $player->rabbits = 0;
            $player->sheep = 0;
            $player->pigs = 0;
            $player->cows = 0;
            $player->horses = 0;
            $player->small_dogs = 0;
            $player->big_dogs = 0;
            if($firstPlayer){
                $player->round = 1;
                $firstPlayer = false;
            }
            else $player->round = 0;
            $player->save();
        }
    }

    //for Display
    public function setAnimalToTrade($animal){
        $this->animalToTrade = $animal;
    }

    public function returnTextSellOrBuy($price): string
    {
        if($price>0) return "Sprzedam";
        else return "Kupie";
    }

    public function returnTextPrice($price): string
    {
        if($price>0) return "za $price sztuk";
        else {
            $price *=-1;
            return "oddam $price za ";
        }
    }

    public function tradeMenuDisplay(){
        $this->handelMenu=!$this->handelMenu;
    }

    public function tradeForm($animal){
        $this->playerPickToTrade = true;
        $this->currentAnimal = $animal;
    }

    public function setTradeTargetAndCount($animal,$count){
        $this->forAnimal = $animal;
        $this->count = $count;
    }

    public function pickToTradeHidden(){
        $this->playerPickToTrade = false;
    }

    private function checkPlayerRound($id){
        $isRound = Player::where('user','=',$id)->first()->round;
        $this->endRound = $isRound;
    }

    private function endGame(){
        $this->endGame = true;
    }

}
