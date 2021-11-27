<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index($id){
        $user = User::where('id','=',$id)->first();
        $tables = Table::all();
        return view('admin.tables', compact( 'user', 'tables'));
    }
}
