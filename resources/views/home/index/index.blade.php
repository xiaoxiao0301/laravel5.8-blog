@extends('layout.home')
@section('seo')
    <title>{{config('web.web_title')}}</title>
    <meta name="keywords" content="{{config('web.web_keywords')}}" />
    <meta name="description" content="{{config('web.web_description')}}" />
@endsection
@section('content')
    <div class="banner">
        <section class="box">
            <ul class="texts">
                <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
                <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
                <p>加了锁的青春，不会再因谁而推开心门。</p>
            </ul>
        </section>
    </div>
    <div class="template">
        <div class="box">
            <h3>
                <p><span>站长推荐</span> Articles</p>
            </h3>
            <ul>
                @foreach($hot as $k => $v)
                    <li>
                        <a href="{{url('articles/'.$v->art_id)}}"  target="_blank"><img src="{{url($v->art_thumb)}}"></a><span>{{$v->art_title}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <article class="blogs">
        <h3 class="title_tj">
            <p>文章<span>列表</span></p>
        </h3>
        <div class="bloglist left">
            @foreach($lists as $list)
                <h3>{{$list->art_title}}</h3>
                <figure><img src="{{url($list->art_thumb)}}"></figure>
                <ul>
                    <p>{{$list->art_description}}</p>
                    <a title="{{$list->art_title}}" href="{{url('articles/'.$list->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
                </ul>
                <p class="dateview"><span>{{$list->art_timer}}</span><span>作者：{{$list->art_author}}</span><span>栏目：[<a href="{{url('category/'.$list->category->cate_id)}}">{{$list->category->cate_name}}</a>]</span></p>
            @endforeach
            <div class="page">
                {{$lists->links()}}
            </div>
        </div>
        <aside class="right">
            @component('layout.share')
            @endcomponent
            <div class="news">
                <h3>
                    <p>最新<span>文章</span></p>
                </h3>
                <ul class="rank">
                    @foreach($news as $new)
                        <li><a href="{{url('articles/'.$new->art_id)}}" title="{{$new->art_title}}" target="_blank">{{$new->art_title}}</a></li>
                    @endforeach
                </ul>
                <h3 class="ph">
                    <p>点击<span>排行</span></p>
                </h3>
                <ul class="paih">
                    @foreach($hot as $k => $item)
                        <li> <p class="c{{$k %2 == 0 ? 0 : 1}}"><span>{{$k+1}}</span></p><a href="{{url('articles/'.$item->art_id)}}" title="{{$item->art_title}}" target="_blank">{{$item->art_title}}</a></li>
                    @endforeach
                </ul>
                <h3 class="links">
                    <p>友情<span>链接</span></p>
                </h3>
                <ul class="website">
                    @foreach($links as $link)
                        <li><a href="{{url($link->links_url)}}" target="_blank" rel="nofollow">{{$link->links_name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </article>
    <script>
        WIDGET = {ID: 'qorXqjxkob'};
    </script>
    <script type="text/javascript" src="https://apip.weatherdt.com/view/static/js/r.js?v=1111"></script>
@endsection
