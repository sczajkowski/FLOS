<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
        public function login(){

            return redirect('/user');
            

        }


        public function create(Request $request){
            //
        }

        public function store()
        {
            return view('user');
        }


}
