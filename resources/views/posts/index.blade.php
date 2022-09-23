<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="{{ asset('css/posts.css')}}" rel="stylesheet">
    </head>
    <body class="antialiased">
        @extends("header")
        @section("content")
        <div class="content">
            <div class="page-ttl">Q&A</div>
            
            <div class="search-box">
              <form action="{{ route('posts.index') }}" method="GET">
                <input class="input" type="text" name="keyword" value="{{ $keyword }}" placeholder="例：リレーション">
                <input type="submit" value="検索">
              </form>
            </div>
            
            <div class="posts">
                @if (count($posts) == 0)
                    <p class="no-post">検索結果無し</p>
                @else
                    @foreach ($posts as $post)
                        @if (isset($post->access_count->counts))
                            <form method="post" action="/posts/{{ $post->id }}/{{ $post->access_count->id }}">
                                @csrf
                                @method('put')
                                <button class="post" type="submit">
                                    <pre class="title">{{ $post->title }}</pre>
                    
                                    <p class="name">{{ $post->user->name }}<p>
                                    
                                    <div class="post-item">
                                        <p class="problem">発生した問題・疑問<p>
                                        <pre>{{ $post->problem }}</pre>
                                    </div>
                                </button>
                            </form>
                        @else
                            <form method="post" action="/posts/{{ $post->id }}">
                                @csrf
                                <button class="post" type="submit">
                                    <pre class="title">{{ $post->title }}</pre>
                    
                                    <p class="name">{{ $post->user->name }}<p>
                                    
                                    <div class="post-item">
                                        <p class="problem">発生した問題・疑問<p>
                                        <pre>{{ $post->problem }}</pre>
                                    </div>
                                </button>
                            </form>
                        @endif
                    @endforeach
                @endif
            </div>
            
            <div class="paginate">
                {{ $posts->links() }}
            </div>
        </div>
        @endsection
    </body>
</html>
