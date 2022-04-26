<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
	class Game_Play extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Player
 *
 * @property int $id
 * @property string $name
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
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player wherePigs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereRabbits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereSheep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereSmallDogs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Player extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lobby
 *
 * @property int $id
 * @property string $name
 * @property int|null $player_1
 * @property int|null $player_2
 * @property int|null $player_3
 * @property int|null $player_4
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room wherePlayer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room wherePlayer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room wherePlayer3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room wherePlayer4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Room extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class User extends \Eloquent {}
}

