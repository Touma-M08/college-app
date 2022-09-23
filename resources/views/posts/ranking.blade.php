<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="{{ asset('css/posts.css')}}" rel="stylesheet">
    </head>
    <body class="antialiased">
        @extends("header")
        @section("content")
        <div class="content">
            <div class="page-ttl">Q&A アクセスランキング</div>
            
            <div class="posts">
                @foreach ($posts as $post)
                    <form method="post" action="/posts/{{ $post->post->id }}/{{ $post->id }}">
                        @csrf
                        @method('put')
                        <button class="post" type="submit">
                            <pre class="title">{{ $post->post->title }}</pre>
            
                            <p class="name">{{ $post->post->user->name }}<p>
                            
                            <div class="post-item">
                                <p class="problem">発生した問題・疑問<p>
                                <pre>{{ $post->post->problem }}</pre>
                            </div>
                        </button>
                    </form>
                @endforeach
            </div>
            
            <div class="paginate">
                {{ $posts->links() }}
            </div>
        </div>
        @endsection
    </body>
</html>