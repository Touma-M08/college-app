<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="{{ asset('css/show.css')}}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
        
        <script src="{{ asset('js/preview.js')}}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
    </head>
    <body class="antialiased">
        @extends("header")
        @section("content")
        <div class="content">
            <div class="post">
                <pre class="page-ttl title">{{ $post->title }}</pre>
                
                <p class="name">{{ $post->user->name }}<p>
                
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
                        <div class=img-box>
                            <a href="{{ $image->image }}" data-lightbox="group{{$image->post_id}}"><img src="{{ $image->image }}"></a>
                        </div>
                    @endforeach
                    </div>
                </div>
                
                @auth
                    @if($post->user_id == Auth::user()->id)
                        <div class="post-item">
                            <a href="/posts/{{ $post->id }}/edit">編集</a>
                        </div>
                    @endif
                @endauth
            </div>
            
            <div class="comments">
                @if(!(count($comments) == 0))
                <p>コメント一覧</p>
                @foreach ($comments as $comment)
                    <div class="comment">
                        <p>{{ $comment->user->name }}</p>
                        <p>{{ $comment->comment }}</p>
                        
                        <div class="comment-item">
                            <div class="img">
                            @foreach ($com_imgs as $image)
                                @if ($image->comment_id == $comment->id)
                                    <div class=img-box>
                                        <a href="{{ $image->image }}" data-lightbox="com{{$image->comment_id}}"><img src="{{ $image->image }}"></a>
                                    </div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                
                <p>コメント投稿</p>
                
                <form method="post" action="/comment/{{ $post->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="comment-item">
                        <textarea class="input area" name="comment"></textarea>
                    </div>
                    
                    <div class="comment-item">
                        <input type="file" id="Image" name="image[]" multiple>
                        <div id="preview"></div>
                    </div>
                    
                    <input type="submit" class="submit" value="保存">
                </form>
            </div>
        </div>
        @endsection
    </body>
</html>
