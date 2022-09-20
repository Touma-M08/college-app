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
            <p class="page-ttl">制作物登録<p>
            
            <form method="post", action="/works" enctype="multipart/form-data">
                @csrf
                <input class="input" type="hidden", name="work[user_id]" value="{{ Auth::user()->id }}"/>
                
                <div class="work-item">
                    <p>アプリ名</p>
                    <input class="input" type="text", name="work[title]"/>
                </div>
                
                <div class="work-item">
                    <p>アプリ概要</p>
                    <textarea class="input area" name=work[summary]></textarea>
                </div>
                
                <div class="work-item">
                    <p>開発言語</p>
                    <input class="input" type="text", name="work[language]"/>
                </div>
                
                <div class="work-item">
                    <p>デプロイ先リンク</p>
                    <input class="input" type="text", name="work[url]"/>
                </div>
                
                <div class="work-item">
                    <p>github</p>
                    <input class="input" type="text", name="work[github]"/>
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