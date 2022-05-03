<?php

namespace App\Models;


use Illuminate\Support\Facades\URL;

class GameRules
{
    public static array $animalsToTrade = ["rabbits","sheep","pigs","cows","horses","small_dogs","big_dogs"];
    public static array $animalsThrow = ["rabbit","sheep","pig","cow","horse","fox","wolf"];
    public static array $imageAnimals= ['rabbits'=>'/image/rabbit.png','sheep'=>'/image/sheep.png',
            'pigs'=>'/image/pig.png','cows'=>'/image/cow.png',
            'horses'=>'/image/horse.png','small_dogs'=>'/image/small_dog.png',
            'big_dogs'=>'/image/big_dog.png','wolf'=>'/image/wolf.png',
            'fox'=>'/image/fox.png'];
    public static array $tradeArray =[
            'rabbits'=>[
                ['sheep',-6],
                ['pigs',-12],
                ['cows',-36],
                ['small_dogs',-6],
                ['big_dogs',-36]
            ],
            'sheep'=>[
                ['rabbits',6],
                ['pigs',-2],
                ['cows',-6],
                ['horses',-12],
                ['small_dogs',-1],
                ['big_dogs',-6]
            ],
            'pigs'=>[
                ['rabbits',12],
                ['sheep',2],
                ['cows',-3],
                ['horses',-6],
                ['big_dogs',-3]
            ],
            'cows'=>[
                ['rabbits',36],
                ['sheep',6],
                ['pigs',3],
                ['horses',-2],
                ['big_dogs',-1]
            ],
            'horses'=>[
                ['sheep',12],
                ['pigs',6],
                ['cows',2],
            ],
            'small_dogs'=>[
                ['rabbits', 6],
                ['sheep',1],
            ],
            'big_dogs'=>[
                ['rabbits',36],
                ['sheep',6],
                ['pigs',3],
                ['cows',1],
            ]
        ];


    public static function getImage($animal): string
    {
        return URL::asset(GameRules::$imageAnimals[$animal]);
    }
}
