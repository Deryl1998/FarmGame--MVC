<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Room
 *
 * @property int $id
 * @property string $name
 * @property int|null $user_1
 * @property int|null $user_2
 * @property int|null $user_3
 * @property int|null $user_4
 * @property int|null $game_play_id
 * @property int $game_started
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUser1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUser2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUser3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUser4($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereGameStarted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereGamePlayId($value)
 */
class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $guarded = [];
    private array $columnsPlayers = ['user_1','user_2','user_3','user_4'];

    static function createRoom($nameRoom): Room
    {
        $room = new \App\Models\Room();
        $room->name = $nameRoom;
        $room->user_1 = null;
        $room->user_2 = null;
        $room->user_3 = null;
        $room->user_4 = null;
        $room->game_play_id = null;
        $room->game_started=false;
        $room->save();
        return $room;
    }

    public function gameStarted($idGame){
        $this->game_play_id = $idGame;
        $this->game_started=true;
        $this->save();
    }

    public function getColumnsNames(){
        return $this->columnsPlayers;
    }

    public function getUsers(): array
    {
        $user = array();
        foreach($this->columnsPlayers as $col){
            if($this[$col]!=null) $user[] = User::find($this[$col]);
            else $user[] = new \App\Models\User;
        }
        return $user;
    }

    public function removePlayer($playerID){
        foreach($this->columnsPlayers as $col){
            if($this[$col]==$playerID) $this->update([$col => null]);
        }
    }

    public function isInRoom($playerID):bool{
        foreach($this->columnsPlayers as $col){
            if($this[$col]==$playerID) return true;
        }
        return false;
    }
}
