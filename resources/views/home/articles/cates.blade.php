@extends('layout.home')
@section('seo')
    <title>{{config('web.web_title')}}</title>
    <meta name="keywords" content="{{$cate->cate_keywords}}" />
    <meta name="description" content="{{$cate->cate_describe}}" />
@endsection
@section('content')
    <article>
        <h1 class="t_nav"><span>{{$cate->cate_title}}。</span><a href="{{url('/')}}" class="n1" target="_blank">网站首页</a><a href="#" class="n2">{{$cate->cate_name}}</a></h1>
        <div class="newblog left">
            @if(empty($links->toArray()['data']))
                <h3 style="margin-top: 100px; text-align: center;">当前栏目下暂无文章信息</h3>
            @else
                @foreach($links as $list)
                    <h2>{{$list->art_title}}</h2>
                    <figure style="margin-top: 20px"><img src="{{url($list->art_thumb)}}"></figure>
                    <ul>
                        <p style="position: relative;left: 8%;top: 22px;">{{$list->art_description}}</p>
                        <a title="{{$list->art_title}}" href="{{url('articles/'.$list->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
                    </ul>
                    <p class="dateview"><span>{{$list->art_timer}}</span><span>作者：{{$list->art_author}}</span><span>栏目：[<a href="{{url('category/'.$list->category->cate_id)}}">{{$list->category->cate_name}}</a>]</span></p>
                @endforeach
                <div class="page">
                    {{$links->links()}}
                </div>
            @endif
        </div>
        <aside class="right">
            <div class="rnav">
                <ul>
                    @foreach($subCates as $sub)
                        <li class="rnav1"><a href="{{url('category/'.$sub->cate_id)}}" target="_blank">{{$sub->cate_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="news">
                <h3>
                    <p>最新<span>文章</span></p>
                </h3>
                <ul class="rank">
                    @if(collect($news)->isEmpty())
                        <li><span>暂无文章上新</span></li>
                    @else
                        @foreach($news as $new)
                            <li><a href="{{url('articles/'.$new->art_id)}}" title="{{$new->art_title}}" target="_blank">{{$new->art_title}}</a></li>
                        @endforeach
                    @endif
                </ul>
                <h3 class="ph">
                    <p>点击<span>排行</span></p>
                </h3>
                <ul class="paih">
                    @if(collect($hot)->isEmpty())
                        <li><span>暂无文章</span></li>
                    @else
                        @foreach($hot as $k =>$item)
                            <li> <p class="c{{$k %2 == 0 ? 0 : 1}}"><span>{{$k+1}}</span></p><a href="{{url('articles/'.$item->art_id)}}" title="{{$item->art_title}}" target="_blank">{{$item->art_title}}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
{{--            <div class="visitors">--}}
{{--                <h3><p>最近访客</p></h3>--}}
{{--                <ul>--}}

{{--                </ul>--}}
{{--            </div>--}}

        </aside>
    </article>
@endsection
