<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Player;

class Game_Play extends Model
{
    use HasFactory;

    protected $table = 'game_play';
    protected $fillable =[
        'player_1','player_2','player_3','player_4','current_player',
        'rabbits','sheep','pigs','cows','horses','small_dogs','big_dogs'
    ];

}
