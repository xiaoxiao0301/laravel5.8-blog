@extends('layout.home')
@section('seo')
    <title>{{config('web.web_title')}}</title>
    <meta name="keywords" content="{{$articles->art_tag}}" />
    <meta name="description" content="{{$articles->art_description}}" />
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span style="margin-right: 67px">您当前的位置：<a href="{{url('/')}}">首页</a>&nbsp;&gt;&nbsp;<a href="{{url('category/'.$articles->category->cate_id)}}">{{$articles->category->cate_name}}</a>&nbsp;</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('category/'.$articles->category->cate_id)}}" class="n2" target="_blank">{{$articles->category->cate_name}}</a></h1>
        <div class="index_about">
            <h2 class="c_titile">{{$articles->art_title}}</h2>
            <p class="box_c"><span class="d_time">发布时间：{{$articles->art_timer}}</span><span>编辑：{{$articles->author}}</span><span>查看次数：{{$articles->art_view+1}}</span></p>
            <ul class="infos">
                {!! $articles->art_content !!}
            </ul>
            <div class="keybq">
                <p><span>关键字词</span>：{{$articles->art_tag}}</p>
            </div>
            <div class="ad"> </div>
            <div class="nextinfo">
                <p>上一篇：
                    @if(is_null($prev))
                        <span>没有上一篇了</span>
                    @else
                        <a href="{{url('articles/'.$prev->art_id)}}" title="{{$prev->art_title}}" target="_blank">{{$prev->art_title}}</a>
                    @endif
                </p>
                <p>下一篇：
                    @if(is_null($next))
                        <span>没有下一篇了</span>
                    @else
                        <a href="{{url('articles/'.$next->art_id)}}" title="{{$next->art_title}}" target="_blank">{{$next->art_title}}</a>
                    @endif
                </p>
            </div>
            <div class="otherlink">
                <h2>相关文章</h2>
                <ul>
                    @foreach($hots as $k => $item)
                        <li><a href="{{url('articles/'.$item->art_id)}}" title="{{$item->art_title}}" target="_blank">{{$item->art_title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <aside class="right">
            @component('layout.share')
            @endcomponent
            <div class="blank"></div>
            <div class="news">
                <h3>
                    <p>栏目<span>最新</span></p>
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
                    @foreach($hots as $k => $item)
                        <li> <p class="c{{$k %2 == 0 ? 0 : 1}}"><span>{{$k+1}}</span></p><a href="{{url('articles/'.$item->art_id)}}" title="{{$item->art_title}}" target="_blank">{{$item->art_title}}</a></li>
                    @endforeach
                </ul>
            </div>
{{--            <div class="visitors">--}}
{{--                <h3>--}}
{{--                    <p>最近访客</p>--}}
{{--                </h3>--}}
{{--                <ul>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </aside>
    </article>
@endsection
