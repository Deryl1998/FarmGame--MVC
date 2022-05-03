<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Player;

/**
 * App\Models\Game_Play
 *
 * @property int $id
 * @property int $player_1
 * @property int $player_2
 * @property int|null $player_3
 * @property int|null $player_4
 * @property int $current_player
 * @property int $rabbits
 * @property int $sheep
 * @property int $pigs
 * @property int $cows
 * @property int $horses
 * @property int $small_dogs
 * @property int $big_dogs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play query()
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play whereBigDogs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play whereCows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play whereCurrentPlayer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play whereHorses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play wherePigs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play wherePlayer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play wherePlayer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play wherePlayer3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play wherePlayer4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play whereRabbits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play whereSheep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play whereSmallDogs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game_Play whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Game_Play extends Model
{
    use HasFactory;

    protected $table = 'game_play';
    protected $guarded = [];

    static function createGame($players): int
    {   $game = new \App\Models\Game_Play();
        $game->player_1 = $players[0];
        $game->player_2 = $players[1];
        $game->player_3 = $players[2];
        $game->player_4 = $players[3];
        $game->current_player = $players[0];
        $game->rabbits=60;
        $game->sheep=24;
        $game->pigs=20;
        $game->cows=12;
        $game->horses=6;
        $game->small_dogs=4;
        $game->big_dogs=2;
        $game->save();
        return $game->id;
    }

    public function getPlayers(): array
    {
        return [\App\Models\Player::find($this->player_1), \App\Models\Player::find($this->player_2), \App\Models\Player::find($this->player_3),
            \App\Models\Player::find($this->player_4)];
    }

    public function getCurrentPlayer(){
        return \App\Models\Player::find($this->current_player);
    }

    private function setRound($id, $round){
        \App\Models\Player::find($id)->update(["round" =>$round]);
    }

    public function changePlayer(){
        $tab = ["player_1","player_2","player_3","player_4"];
        $this->setRound($this->current_player,false);
        $max = 1;
        if($this->player_3!=null) $max++;
        if($this->player_4!=null) $max++;
        $nextPlayer=0;
        for($i=0;$i<=$max;$i++){ // players loop
            if($this->current_player == $this[$tab[$i]]){
                $nextPlayer = ($this->current_player == $this[$tab[$max]])? $this[$tab[0]] : $this[$tab[$i+1]];
                break;
            }
        }
        $this->current_player = $nextPlayer;
        $this->setRound($this->current_player,true);
        $this->save();
    }

}
