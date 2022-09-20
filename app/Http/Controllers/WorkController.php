<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Models\Work;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Work::query();

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('language', 'LIKE', "%{$keyword}%");
        }

        $works = $query->orderBy("created_at", "desc")->paginate(15);

        return view('works/index', compact('works', 'keyword'));
    }
    
    public function create()
    {
        return view('works/create');
    }
    
    public function store(Request $request, Work $work) 
    {
        $input = $request['work'];
        $work->fill($input);
        
        $path = Storage::disk('s3')->putFile('works', $request->image, 'public');
        $work->image = Storage::disk('s3')->url($path);
        
        $work->save();
        
        return redirect("/works");
    }
    
    public function edit(Work $work) 
    {
        return view('works/edit')->with(["work" => $work]);
    }
    
    public function update(Request $request, Work $work) 
    {
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
    
    public function delete(Work $work)
    {
        $work->delete();
        
        return redirect("/works");
    }
}
