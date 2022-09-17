<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Models\Work;

class WorkController extends Controller
{
    public function index(Work $work) {
        return view('works/index')->with(["works" => $work->get()]);
    }
    
    public function create() {
        return view('works/create');
    }
    
    public function store(Request $request, Work $work) {
        $input = $request['work'];
        $work->fill($input);
        
        $path = Storage::disk('s3')->putFile('works', $request->image, 'public');
        $work->image = Storage::disk('s3')->url($path);
        
        $work->save();
        
        return redirect("/works");
    }
}
