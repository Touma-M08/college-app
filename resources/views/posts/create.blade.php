<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="{{ asset('js/preview.js')}}" defer></script>
        
        <link href="{{asset('css/postsCreate.css')}}" rel="stylesheet">
    </head>
    <body class="antialiased">
        @extends("header")
        @section("content")
        <div class="content">
            <p class="page-ttl">Q&A投稿<p>
            
            <form method="post", action="/posts" enctype="multipart/form-data">
                @csrf
                <input class="input" type="hidden", name="post[user_id]" value="{{ Auth::user()->id }}">
                <div class="post-item">
                    <p>タイトル</p>
                    <input class="input" type="text", name="post[title]">

                    @error("post.title")
                        <p>{{$message}}</p>
                    @enderror
                </div>
                
                <div class="post-item">
                    <p>発生した問題・疑問点</p>
                    <textarea class="input area" name=post[problem]></textarea>
                    
                    @error("post.problem")
                        <p>{{$message}}</p>
                    @enderror
                </div>
                
                <div class="post-item">
                    <p>解決方法</p>
                    <textarea class="input area" name="post[solution]"></textarea>
                    
                    @error("post.solution")
                        <p>{{$message}}</p>
                    @enderror
                </div>
                
                <div class="post-item">
                    <p>エラー画像など</p>
                    <input type="file" id="Image" name="image[]" multiple>
                    <div id="preview"></div>
                    
                    @error("image")
                        <p>{{$message}}</p>
                    @enderror
                </div>
                
                
                <input class="submit" type="submit" value="送信">
            </form>
        </div>
        @endsection
    </body>
</html>