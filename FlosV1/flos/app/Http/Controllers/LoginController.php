<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('welcome');
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
