<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="{{ asset('css/works.css')}}" rel="stylesheet">
        
        <script src="{{asset('js/modalToggle.js')}}" defer></script>
    </head>
    <body class="antialiased">
        @extends("header")
        @section("content")
        <div class="content">
            <div class="page-ttl">制作物一覧</div>
            
            <div class="search-box">
              <form action="{{ route('works.index') }}" method="GET">
                <input class="input" type="text" name="keyword" value="{{ $keyword }}" placeholder="アプリ名、開発言語">
                <input type="submit" value="検索">
              </form>
            </div>
            
            <div class="works">
                @if (count($works) == 0)
                    <p>検索結果無し</p>
                @else
                    @foreach ($works as $work)
                    <div class="work">
                        <div class="item">
                            <div class="img-box">
                                @if(isset($work->image))
                                    <img src="{{ $work->image }}">
                                @else
                                    <img src="/img/noimage.jpg">
                                @endif
                            </div>
                            <h2 class="app-ttl">{{ $work->title }}</h2>
                        </div>
                            
                        <div class="modal">
                            <div class="modal-pos">
                                <div class="close">
                                    <i class="fa-solid fa-xmark"></i>
                                </div>
                                
                                @auth
                                    @if ($work->user_id == Auth::user()->id)
                                        <div class="edit">
                                            <a href="/works/{{ $work->id }}/edit">編集</a>
                                        </div>
                                        
                                        <form action="/works/{{ $work->id }}" id="form_{{ $work->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete" type="button" onclick="deleteData({{ $work->id }})">削除</button> 
                                        </form>
                                    @endif
                                @endauth
                                <div class="modal-img-box">
                                    @if(isset($work->image))
                                        <a href="{{ $work->image }}" data-lightbox="group{{$work->id}}">
                                            <img src="{{ $work->image }}">
                                        </a>
                                    @else
                                            <img src="/img/noimage.jpg">
                                    @endif
                                </div>
                                
                                <h2>{{ $work->title }}</h2>
                                <p>制作者:{{ $work->user->name }}<p>
                                    
                                <div class="flex">
                                    <div class="w48">
                                        <p>アプリ概要<p>
                                        <pre class="text">{{ $work->summary }}<pre>
                                    </div>
                                    
                                    <div class="w48">
                                        <p>開発言語<p>
                                        <p>{{ $work->language }}<p>
                                        <div class="btn-pos">
                                            @if(isset($work->url))
                                                <div>
                                                    <a href="{{ $work->url }}">リンク</a>
                                                </div>
                                            @endif
                                            
                                            @if(isset($work->github))
                                                <div>
                                                    <a href="{{ $work->github }}">github</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            
            <div class="paginate">
                {{ $works->links() }}
            </div>
        </div>
        @endsection
    </body>
</html>