<?php

namespace App\Http\Middleware;

use App\Http\Controllers\RoomController;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LastUserActivity
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
        $user = User::find(session("userID"));
        if($user==null)
            return redirect("/");
        $roomAction = "App\Http\Livewire\Room";
        $prevAction = session('lastPlaceUserVisit');
        $currentAction = Route::getCurrentRoute()->getActionName();
        $request->session()->put('lastPlaceUserVisit',$currentAction);
        $user->updated_at=date('Y-m-d H:i:s');
        $user->save();
        if($prevAction==$roomAction && $currentAction!=$roomAction){
            RoomController::removeUserFromQueue($request);
        }

        return $next($request);
    }
}
