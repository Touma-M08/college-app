<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="{{asset('css/worksCreate.css')}}" rel="stylesheet">
        <script src="{{ asset('js/preview.js')}}" defer></script>
    </head>
    <body class="antialiased">
        @extends("header")
        @section("content")
        <div class="content">
            <p class="page-ttl">制作物投稿<p>
            
            <form method="post", action="/works/{{ $work->id }}/update" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="work-item">
                    <p>アプリ名</p>
                    <input class="input" type="text" name="work[title]" value="{{ $work->title }}"/>
                    @error("post.title")
                        <p>{{$message}}</p>
                    @enderror
                </div>
                
                <div class="work-item">
                    <p>アプリ概要</p>
                    <textarea class="input area" name=work[summary]>{{ $work->summary }}</textarea>
                </div>
                
                <div class="work-item">
                    <p>開発言語</p>
                    <input class="input" type="text" name="work[language]" value="{{ $work->language }}"/>
                </div>
                
                <div class="work-item">
                    <p>デプロイ先リンク</p>
                    <input class="input" type="text" name="work[url]" value="{{ $work->url }}"/>
                </div>
                
                <div class="work-item">
                    <p>github</p>
                    <input class="input" type="text" name="work[github]" value="{{ $work->github }}"/>
                </div>
                
                <div class="work-item">
                    <p>サムネイル・トップページの画像など</p>
                    <input type="file" id="Image" name="image">
                    <div id="preview">
                </div>
                
                <input class="submit" type="submit" value="送信"/>
            </form>
        </div>
        @endsection
    </body>
</html>