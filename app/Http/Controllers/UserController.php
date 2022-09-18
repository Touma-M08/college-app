<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit() {
        return view("setting");
    }
    
    public function update(Request $request) {
        Auth::user()->fill($request["user"])->save();
        
        return redirect('/');
    }
    
    public function updatePass(Request $request) {
        Auth::user()->password = Hash::make($request['user.password']);
        Auth::user()->save();
        
        return redirect('/');
    }
}
