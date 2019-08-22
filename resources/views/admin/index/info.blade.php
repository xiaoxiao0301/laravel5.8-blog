@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 系统信息
    </div>
    <!--面包屑导航 结束-->

    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系统</label><span>{{$data['os']}}</span>
                </li>
                <li>
                    <label>运行环境</label><span>{{$data['environment']}} </span>
                </li>
                <li>
                    <label>PHP版本</label><span>{{$data['version']}}</span>
                </li>
                <li>
                    <label>文件上传限制</label><span>{{$data['fileUpload']}}</span>
                </li>
                <li>
                    <label>北京时间</label><span>{{date('Y-m-d H:i:s', time())}}</span>
                </li>
                <li>
                    <label>服务器域名/IP</label><span>{{$data['domain']}} [ {{$data['ip']}}]</span>
                </li>
            </ul>
        </div>
    </div>

    <!--结果集列表组件 结束-->
@endsection

