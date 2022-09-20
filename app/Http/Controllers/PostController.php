<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Models\Post;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Comment_image;
use App\Models\Access_count;

class PostController extends Controller
{
    public function index(Request $request) 
    {
        $keyword = $request->keyword;

        $query = Post::query();

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('problem', 'LIKE', "%{$keyword}%")
                ->orWhere('solution', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->orderBy("created_at", "desc")->paginate(20);

        return view('posts/index')->with([
            "posts" => $posts,
            "keyword" => $keyword
        ]);
    }
    
    public function ranking(Access_count $access_count) 
    {
        return view('posts/ranking')->with([
            "posts" => $access_count->orderBy("counts", "desc")->paginate(10)
        ]);
    }
    
    public function create() 
    {
        return view('posts/create');
    }
    
    public function store(Request $request, Post $post) 
    {
        if ($request->image == null) {
            $count = 0;
        }else {
            $count = count($request->image);
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
    
    public function show(Post $post, Image $image, Comment $comment, Comment_image $comment_image) 
    {
        return view('posts/show')->with([
            "post" => $post,
            "images" => $image->where('post_id', $post->id)->get(),
            "comments" => $comment->where('post_id', $post->id)->get(),
            "com_imgs" => $comment_image->get()
        ]);
    }
    
    public function edit(Post $post) 
    {
        return view('posts/edit')->with(["post" => $post]);
    }
    
    public function update(Request $request, Post $post) 
    {
        if ($request->image == null) {
            $count = 0;
        }else {
            $count = count($request->image);
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
    
    public function countStore(Access_count $access_count, Post $post)
    {
        $access_count->counts = 1;
        $access_count->post_id = $post->id;
        $access_count->save();
        
        return redirect("/posts/".$post->id);
    }
    
    public function countUp(Post $post, Access_count $access_count)
    {
        $access_count->counts += 1;
        $access_count->save();
        
        return redirect("/posts/".$post->id);
    }
}
