<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserPassRequest;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit() {
        return view("setting");
    }
    
    public function update(UserRequest $request) {
        Auth::user()->fill($request["users"])->save();
        
        return redirect('/');
    }
    
    public function updatePass(UserPassRequest $request) {
        Auth::user()->password = Hash::make($request->password);
        Auth::user()->save();
        
        return redirect('/');
    }
}
