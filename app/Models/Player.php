<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Player
 *
 * @property int $id
 * @property int|null $user
 * @property int $rabbits
 * @property int $sheep
 * @property int $pigs
 * @property int $cows
 * @property int $horses
 * @property int $small_dogs
 * @property int $big_dogs
 * @property int $round
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereBigDogs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereCows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereHorses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player wherePigs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereRabbits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereSheep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereSmallDogs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereUser($value)
 * @mixin \Eloquent
 */
class Player extends Model
{
    use HasFactory;
    protected $table = 'players';
    protected $guarded = [];
    function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->user=null;
    }

    static function createNewPlayer($userID): int
    {
        $player = new \App\Models\Player;
        $player->user = $userID;
        $player->rabbits = 0;
        $player->sheep = 0;
        $player->pigs = 0;
        $player->cows = 0;
        $player->horses = 0;
        $player->small_dogs = 0;
        $player->big_dogs = 0;
        $player->round = false;
        $player->save();
        return $player->id;
    }

    public function getPlayer()
    {
        return $this;
    }

    public function getPlayerName()
    {
        return User::find($this->user)->name;
    }

    public function isHaveAnimals(): bool
    {
        if($this->rabbits == 0 && $this->sheep == 0 && $this->pigs == 0 &&
            $this->cows == 0 &&  $this->horses == 0) return false;
        return true;
    }

    public function isWin(): bool
    {
        if($this->rabbits > 0 && $this->sheep > 0 && $this->pigs > 0 &&
            $this->cows > 0 &&  $this->horses > 0) return true;
        return false;
    }
}
