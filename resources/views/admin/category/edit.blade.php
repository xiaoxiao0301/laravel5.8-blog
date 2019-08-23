@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 编辑分类
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
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-refresh"></i>全部分类</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/category/'.$cate->cate_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>父级分类：</th>
                    <td>
                        <select name="cate_pid">
                            <option value="0">==顶级分类==</option>
                            @foreach($data as $k => $v)
                                <option value="{{$v->cate_id}}" @if($v->cate_id == $cate->cate_pid) selected @endif>{{$v->cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分类名称：</th>
                    <td>
                        <input type="text" name="cate_name" value="{{$cate->cate_name}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th>分类标题：</th>
                    <td>
                        <input type="text" class="lg" name="cate_title" value="{{$cate->cate_title}}">
                    </td>
                </tr>
                <tr>
                    <th>关键字：</th>
                    <td>
                        <textarea name="cate_keywords">{{$cate->cate_keywords}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea name="cate_describe">{{$cate->cate_describe}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" class="sm" name="cate_order" value="{{$cate->cate_order}}">
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
