<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('welcome');
    }

    function check(Request $request){

        $user = User::where('pin','=',$request->pin)->first();
        //return $request->pin;
        return $user;

        /*User::where('pin','=', $request->pin)->first();
        $user = User::where('pin','=', $request->pin)->first();
        if($user){
            $request->session()->put('LoggedUser', $user->id);
            return redirect('user');
        }else{
            return back()->with('fail', 'No account found for this pin');
        }*/
    }
}
