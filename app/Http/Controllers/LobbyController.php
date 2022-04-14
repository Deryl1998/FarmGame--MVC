<?php

namespace App\Http\Controllers;

use app\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Sodium\add;


class LobbyController extends Controller
{
    public function getLobbyView()
    {
        return view('lobby');
    }

    public function getLobbyForm(Request $settings)
    {
        $counts= $settings->get('players');
        $settings->validate(
                [
                    'p1' => 'required|min:3',
                    'p2' => 'required|min:3'
                ]
        );
        $array = array($settings->Input('p1'), $settings->Input('p2'));

        if ($counts == '3') {
            $settings->validate(
                [
                    'p3' => 'required|min:3'
                ]
            );
            array_push($array,$settings->Input('p3'));
        }
        else if ($counts == '4') {
            $settings->validate(
                [
                    'p3' => 'required|min:3',
                    'p4' => 'required|min:3'
                ]
            );
            array_push($array,$settings->Input('p3'));
            array_push($array,$settings->Input('p4'));
        }

        $playersID=array();
        for($i=0;$i<4;$i++){
            if($i<$counts) {
                $players = new \App\Models\Player;
                $players->name = $array[$i];
                $players->rabbits = 0;
                $players->sheep = 0;
                $players->pigs = 0;
                $players->cows = 0;
                $players->horses = 0;
                $players->small_dogs = 0;
                $players->big_dogs = 0;
                $players->save();
                $playersID[$i] = "$players->id";
            }
            else $playersID[$i] = "0";
        }
        return redirect("lobby/pass/game_play/$playersID[0]/$playersID[1]/$playersID[2]/$playersID[3]");
    }


}
