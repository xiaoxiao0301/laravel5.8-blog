@extends('layout.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 编辑配置项
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
                <a href="{{url('admin/configs')}}"><i class="fa fa-refresh"></i>配置项列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/configs/'.$configs->configs_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>标题：</th>
                    <td>
                        <input type="text" name="configs_title" value="{{$configs->configs_title}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>名称：</th>
                    <td>
                        <input type="text"  name="configs_name" value="{{$configs->configs_name}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>名称值：</th>
                    <td>
                        <textarea name="configs_content">{{$configs->configs_content}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>类型：</th>
                    <td>
                        <select name="field_type" id="field_type" onchange="show(this)">
                            <option value="input" @if($configs->field_type == "input") selected @endif>input</option>
                            <option value="textarea" @if($configs->field_type == "textarea") selected @endif>textarea</option>
                            <option value="radio" @if($configs->field_type == "radio") selected @endif>radio</option>
                        </select>
                        <span><i class="fa fa-exclamation-circle yellow"></i>类型: input textarea radio</span>
                    </td>
                </tr>
                <tr style="display: none" id="field_value">
                    <th><i class="require">*</i>类型值：</th>
                    <td>
                        <input type="text"  name="field_value" value="{{$configs->field_value}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>类型为radio需要填写此项 1|开启 0|关闭</span>
                    </td>
                </tr>

                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" class="sm" name="configs_order" value="{{$configs->configs_order}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>描述：</th>
                    <td>
                        <textarea name="configs_tips">value="{{$configs->configs_tips}}"</textarea>
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
    <script>
        $(function () {
            choosed = "{{$configs->field_type}}";
            if (choosed == 'radio') {
                $("#field_value").show();
            } else {
                $("#field_value").hide();
            }
        })
        function show(obj) {
            chooseValue = $(obj).find("option:selected").val();
            if (chooseValue == 'radio') {
                $("#field_value").show();
            } else {
                $("#field_value").hide();
            }
        }
    </script>
@endsection
