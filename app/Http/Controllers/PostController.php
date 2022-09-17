<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Models\Post;
use App\Models\Image;

class PostController extends Controller
{
    public function index(Post $post, Image $image) {
        return view('posts/index')->with([
            "posts" => $post->get(),
            "images" => $image->get()
        ]);
    }
    
    public function create() {
        return view('posts/create');
    }
    
    public function store(Request $request, Post $post) {
        $count = count($request->image);
        if ($request->image[0] == null) {
            $count = 0;
        }
    
        $input = $request['post'];
        $post->fill($input)->save();
        
        
        if (!($count == 0)) {
            for ($i = 0; $i < $count; $i++) {
                $image = new Image;
                $image->post_id = $post->id;
    
                $path = Storage::disk('s3')->putFile('image', $request->image[$i], 'public');
                $image->image = Storage::disk('s3')->url($path);
                
                $image->save();
            }
        }
        
        return redirect("/");
    }
}
