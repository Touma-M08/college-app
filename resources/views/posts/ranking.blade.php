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
                    <div class="post">
                        <pre class="title">{{ $post->post->title }}</pre>
                        
                        <p class="name">{{ $post->post->user->name }}<p>
                        
                        <div class="post-item">
                            <p>・発生した問題・疑問<p>
                            <pre>{{ $post->post->problem }}</pre>
                        </div>
                        
                        @if (isset($post->post->access_count->counts))
                            <form method="post" action="/posts/{{ $post->post->id }}/{{ $post->post->access_count->id }}">
                                @csrf
                                @method('put')
                                <input type="submit" value="詳細">
                            </form>
                        @else
                            <form method="post" action="/posts/{{ $post->post->id }}">
                                @csrf
                                <input type="submit" value="詳細">
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
            
            <div class="paginate">
                {{ $posts->links() }}
            </div>
        </div>
        @endsection
    </body>
</html>