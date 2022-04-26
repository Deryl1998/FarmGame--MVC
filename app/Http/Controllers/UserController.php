<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function createUser(Request $settings){
        $pdo = DB::connection()->getPdo();
        if($pdo) {
            $settings->validate(
                [
                    'p1' => 'required|min:3|max:15',
                ]);
            $user = new \App\Models\User;
            $user->name = $settings->Input('p1');
            $user->save();
            $settings->session()->put('userID', $user->id);
            return redirect("lobby/list");
        }
    }

    public function getStartView(){
        return view('create_User');
    }
}
