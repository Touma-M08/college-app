<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Post;

class ImageController extends Controller
{
    public function delete(Image $image, Post $post)
    {
        $image->delete();
        
        return redirect('/posts/'.$post->id."/edit");
    }
}
