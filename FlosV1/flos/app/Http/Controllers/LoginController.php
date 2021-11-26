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
        if($user)
        {
            if ($user->accountType == 'user'){
                $var = $user->id;
                return redirect()->route('user', $var);
            }
            elseif ($user->accountType == 'admin'){
                $var = $user->id;
                return redirect()->route('admin', $var);
            }
            else{
                return back()->with('fail', 'Something went wrong');
            }
        }else{
            //user not exist
            return back()->with('fail', 'No account found for this pin');
        }
    }
}
