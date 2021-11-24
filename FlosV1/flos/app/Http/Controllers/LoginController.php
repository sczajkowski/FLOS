<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('welcome');
    }


    public function authenticate(Request $request){
        //dd($request->get('pin'));
        $credentials = $request->validate([
            'pin' => ['required']
            ]);

        $pin = $request->get('pin');

        $var = User::with('pin', $pin);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->inrended('admin');
        }

        return back()->withErrors([
            'pin' => 'Błędny PIN',
                                  ]);
    }

    function check(Request $request){
        return $request->input();
    }
}
