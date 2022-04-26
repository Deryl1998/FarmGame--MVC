<?php

namespace App\Http\Middleware;

use App\Models\Room;
use Closure;
use Illuminate\Http\Request;

class isInRoom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $playerID= session('userID');
        $lobby = Room::find(intval(session('userRoom')));
        if($lobby!=null) {
            if ($lobby->game_started == 1 && $lobby->isInRoom($playerID) == true) {
                $request->session()->put('gamePlayID', $lobby->game_play_id);
                return redirect("game_play");
            }

            if ($lobby->isInRoom($playerID) == true)
                return $next($request);
        }

        $request->session()->put('userRoom', null);
         return redirect('lobby/list');
    }
}
