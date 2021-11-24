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
        dd($var);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->inrended('admin');
        }

        return back()->withErrors([
            'pin' => 'Błędny PIN',
                                  ]);
    }

    public function smth(): string
    {
        //$pin = $_POST['pin'];
        //$var = User::where('pin', '123456')->first();

        foreach (User::all() as $user) {
            echo $user->pin;
            echo $user->accountType;
        }

        return 'thats it';


    }
}
