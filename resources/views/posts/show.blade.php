<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="{{ asset('css/show.css')}}" rel="stylesheet">
        <script src="{{ asset('js/preview.js')}}" defer></script>
    </head>
    <body class="antialiased">
        @extends("header")
        @section("content")
        <div class="content">
            <p class="page-ttl">Q&A</p>
            
            <div class="post">
                <pre class="title">{{ $post->title }}</pre>
                
                <p class="name">{{ $post->user->name }}<span>{{ $post->created_at->format("Y.m.d") }}</span><p>
                
                @auth
                    @if($post->user_id == Auth::user()->id)
                        <div class="btn-flex">
                            <div>
                                <a class="edit-btn post-btn" href="/posts/{{ $post->id }}/edit">編集</a>
                            </div>
                            
                            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="delete-btn post-btn" type="button" onclick="deleteData({{ $post->id }})">削除</button> 
                            </form>
                        </div>
                    @endif
                @endauth
                
                <div class="post-item">
                    <p>・発生した問題・疑問<p>
                    <pre>{{ $post->problem }}</pre>
                </div>
                
                <div class="post-item">
                    <p>・解決方法<p>
                    <pre>{{ $post->solution }}</pre>
                </div>
        
                <div class="post-item">
                    <div class="img">
                    @foreach ($images as $image)
                        <div class="img-box">
                            <a href="{{ $image->image }}" data-lightbox="group{{$image->post_id}}"><img src="{{ $image->image }}"></a>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            
            @if(count($comments) != 0)
                <p class="content-ttl">コメント一覧</p>
            @endif
            
            <div class="comments">
                @foreach ($comments as $comment)
                    <div class="comment">
                        <p class="comment-user">{{ $comment->user->name }}<span>{{ $comment->created_at->format("Y.m.d") }}</span></p>
                        
                        <form action="/comments/{{ $comment->id }}/{{ $post->id }}" id="form{{ $comment->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="comment-delete" type="button" onclick="deleteComment({{ $comment->id }})">削除</button> 
                        </form>
                        
                        <p>{{ $comment->comment }}</p>
                        
                        <div class="comment-item">
                            <div class="img">
                            @foreach ($comment->comment_images as $image)
                                <div class="img-box">
                                    <a href="{{ $image->image }}" data-lightbox="com{{$image->comment_id}}"><img src="{{ $image->image }}"></a>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>    
            
               
            <p class="content-ttl posting">コメント投稿</p>
            
            <div class="comments">    
                <form method="post" action="/comments/{{ $post->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="comment-item">
                        <textarea class="input area" name="comment">{{ old('comment') }}</textarea>
                        
                        @error("comment")
                            <p>{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="comment-item">
                        <input type="file" id="Image" name="image[]" multiple>
                        <div id="preview"></div>
                        
                        @error("image")
                            <p>{{$message}}</p>
                        @enderror
                    </div>
                    
                    <input type="submit" class="submit" value="保存">
                </form>
            </div> 
        </div>
        @endsection
    </body>
</html>
