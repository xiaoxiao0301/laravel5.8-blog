@extends('layout.admin')
    @section('content')
        <!--面包屑导航 开始-->
        <div class="crumb_warp">
            <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 修改密码
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>修改密码</h3>
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
        </div>
        <!--结果集标题与导航组件 结束-->

        <div class="result_wrap">
            <form method="post" action="{{url('admin/change')}}">
                {{csrf_field()}}
                <table class="add_tab">
                    <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>原密码：</th>
                        <td>
                            <input type="password" name="password_o"> </i>请输入原始密码</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>新密码：</th>
                        <td>
                            <input type="password" name="password"> </i>新密码6-20位</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>确认密码：</th>
                        <td>
                            <input type="password" name="password_c"> </i>再次输入密码</span>
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
