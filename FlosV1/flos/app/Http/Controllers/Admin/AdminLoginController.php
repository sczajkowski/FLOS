<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function index($id){
        $user = User::where('id','=',$id)->first();
        return view('admin.admin', compact('user'));
    }

}
