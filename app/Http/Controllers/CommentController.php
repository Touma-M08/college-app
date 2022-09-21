<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Storage;
use App\Models\Comment;
use App\Models\Comment_image;
use App\Models\Post;
use Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post, Comment $comment)
    {
        if ($request->image == null) {
            $count = 0;
        }else {
            $count = count($request->image);
        }
    
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->save();
        
        if (!($count == 0)) {
            for ($i = 0; $i < $count; $i++) {
                $image = new Comment_image;
                $image->comment_id = $comment->id;
    
                $path = Storage::disk('s3')->putFile('comment_image', $request->image[$i], 'public');
                $image->image = Storage::disk('s3')->url($path);
                
                $image->save();
            }
        }
        
        return redirect("/posts/".$post->id);
    }
    
    public function delete(Comment $comment, Post $post)
    {
        $comment->delete();
        
        return redirect('/posts/'.$post->id);
    }
}
