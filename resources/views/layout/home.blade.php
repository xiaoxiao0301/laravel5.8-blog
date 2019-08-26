<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('seo')
    <link href="{{asset('home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('home/css/new.css')}}" rel="stylesheet">
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('home/js/modernizr.js')}}"></script>
    <![endif]-->
    <style>
        .paih li {
            position: relative;
        }
        .paih li p {
            position: absolute;
            width: 18px;
            top: 7px;
            height: 16px;
            left: 0px;
            color: #fff;
            border-radius: 4px;
            border: 1px solid;

        }

        .paih li p span {
            position: absolute;
            top: -6px;
            left: 6px;
        }

        .c0 {
            background: #3dc7c7;
        }

        .c1 {
            background: #505050;
        }
    </style>
</head>
<body>
<header>
    <div id="logo"><a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $k => $v)
            <a href="{{url($v->navs_url)}}"><span>{{$v->navs_name}}</span><span class="en">{{$v->navs_alias}}</span></a>
        @endforeach
    </nav>
</header>
@section('content')
@show
<footer>
    <p>{{$footer}}</p>
</footer>
<script src="{{asset('home/js/silder.js')}}"></script>
</body>
</html>
