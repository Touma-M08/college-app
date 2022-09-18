<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Models\Work;

class WorkController extends Controller
{
    public function index(Work $work) {
        return view('works/index')->with(["works" => $work->orderBy("created_at", "desc")->paginate(3)]);
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
    
    public function edit(Work $work) {
        return view('works/edit')->with(["work" => $work]);
    }
    
    public function update(Request $request, Work $work) {
        if ($request->image == null) {
            $work->fill($request['work'])->save();
        } else {
            $work->fill($request['work']);
            $path = Storage::disk('s3')->putFile('works', $request->image, 'public');
            $work->image = Storage::disk('s3')->url($path);
            $work->save();
        }
        
        return redirect("/works");
    }
}
