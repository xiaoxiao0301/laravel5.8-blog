@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 编辑友情链接
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
            @if($errors->any())
                <div class="mark">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><p style="color:red">{{ $error }}</p></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/navs')}}"><i class="fa fa-refresh"></i>全部导航链接</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/navs/'.$links->navs_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>导航名称：</th>
                    <td>
                        <input type="text" name="navs_name" value="{{$links->navs_name}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>链接名称必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>导航别名：</th>
                    <td>
                        <input type="text"  name="navs_alias" value="{{$links->navs_alias}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>链接地址：</th>
                    <td>
                        <input type="text"  name="navs_url" value="{{$links->navs_url}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>链接地址指定路由地址就行</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" class="sm" name="navs_order" value="{{$links->navs_order}}">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection
