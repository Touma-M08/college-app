<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="{{asset('css/postsCreate.css')}}" rel="stylesheet">
        <script src="{{ asset('js/preview.js')}}" defer></script>
    </head>
    <body class="antialiased">
        @extends("header")
        @section("content")
        <div class="content">
            <p class="page-ttl">Q&A編集<p>
            
            <div class="post-item">
                <p>タイトル</p>
                <input class="input" type="text", name="post[title]" value="{{ $post->title }}" form="main"/>
            </div>
            
            <div class="post-item">
                <p>発生した問題・疑問点</p>
                <textarea class="input area" name=post[problem] form="main">{{ $post->problem }}</textarea>
            </div>
            
            <div class="post-item">
                <p>解決方法</p>
                <textarea class="input area" name="post[solution]" form="main">{{ $post->solution }}</textarea>
            </div>
            
            @if(count($images) != 0)
                <div class="post-item">
                    <div class="img">
                    @foreach ($images as $image)
                        <div class="img-box">
                            <a href="{{ $image->image }}" data-lightbox="edit"><img src="{{ $image->image }}"></a>
                        
                            <form action="/images/{{ $image->id }}/{{ $post->id }}" id="form_{{ $image->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="delete-btn" type="button" onclick="deleteData({{ $image->id }})">
                                    <i class="fa-solid fa-xmark"></i>
                                </button> 
                            </form>
                        </div>
                    @endforeach
                    </div>
                </div>
            @endif
            
            <div class="post-item">
                <p>画像追加</p>
                <input type="file" id="Image" name="image[]" multiple form="main">
                <div id="preview"></div>
            </div>
                
            <form method="post", action="/posts/{{ $post->id }}/update" id="main" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input class="submit" type="submit" value="送信"/>
            </form>
            
            
        </div>
        @endsection
    </body>
</html>