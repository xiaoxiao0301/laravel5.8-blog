@extends('layout.admin')
<style>
    .page_list ul li .page-link {
        padding: 6px 12px;
    }
    .page_list ul .active {
        background-color: #2F7BB8;
    }

    .page_list ul .disabled {
        cursor: not-allowed;
    }
</style>
    @section('content')
        <!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;文章分类列表
        </div>
        <!--面包屑导航 结束-->

        <!--搜索结果页面 列表 开始-->
        <form action="{{url('admin/configs/changeContent')}}" method="post">
            {{csrf_field()}}
            <div class="result_wrap">
                <div class="result_title">
                    <h3>配置项列表</h3>
                    @if($errors->any())
                        <div class="mark">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><p>{{ $error }}</p></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <!--快捷导航 开始-->
                <div class="result_content">
                    <div class="short_wrap">
                        <a href="{{url('admin/configs/create')}}"><i class="fa fa-plus"></i>新增配置项</a>
                    </div>
                </div>
                <!--快捷导航 结束-->
            </div>

            <div class="result_wrap">
                <div class="result_content">
                    <table class="list_tab">
                        <tr>
                            <th class="tc" width="5%">排序</th>
                            <th class="tc">ID</th>
                            <th class="tc">标题</th>
                            <th class="tc">名称</th>
                            <th class="tc">名称值</th>
                            <th class="tc">操作</th>
                        </tr>
                        @foreach($data as $k => $v)
                            <tr>
                                <td class="tc">
                                    <input type="text"  value="{{$v->configs_order}}" onchange="changeOrder(this, {{$v->configs_id}})">
                                </td>
                                <td class="tc">{{$v->configs_id}}</td>
                                <td class="tc">
                                    <a href="#" style="float: none;">{{$v->configs_title}}</a>
                                </td><td class="tc">
                                    <a href="#" style="float: none;">{{$v->configs_name}}</a>
                                </td>
                                <td>
                                    <input type="hidden" name="configs_id[]" value="{{$v->configs_id}}">
                                    {!! $v->_html !!}
                                </td>
                                <td class="tc">
                                    <a href="{{url('admin/configs/'.$v->configs_id.'/edit')}}" style="float: none;"><i class="fa fa-fw fa-edit"></i>修改</a>
                                    <a href="javascript:void(0)" style="float: none;" onclick="del(this, {{$v->configs_id}})"><i class="fa fa-fw fa-trash"></i>删除</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="btn_group">
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </div>
                    <div class="page_list" style="text-align: center">
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </form>
        <script>
            function changeOrder(obj, id) {
                orders = $(obj).val();
                $.ajax({
                    url : "{{url('admin/configs/order')}}",
                    method: "post",
                    dataType: "json",
                    data: {
                        _token : "{{csrf_token()}}",
                        order : orders,
                        configs_id : id
                    },
                    success: function (data) {
                        if (data.status == 1) {
                            layer.msg(data.msg, {icon:6, time: 2000},function () {
                                window.location.href = window.location.href;
                            });
                        } else {
                            layer.msg(data.msg, {icon:5, time: 2000})
                        }
                    },
                    error:function (data) {
                        layer.msg("网络错误，请稍后再试!", {icon:2, time:2000});
                    }

                });
            }

            function del(obj, id) {
                layer.confirm('确认删除?', {
                    btn : ['取消', '确认']
                },function (index) {
                    // 对应第一个按钮事件
                    layer.close(index);
                },function () {
                    $.ajax({
                        url : "{{url('admin/configs/')}}/"+id,
                        method: "post",
                        dataType: "json",
                        data: {
                            _token : "{{csrf_token()}}",
                            _method: "delete"
                        },
                        success: function (data) {
                            if (data.status == 1) {
                                layer.msg(data.msg, {icon:6, time: 2000},function () {
                                    $(obj).parent().parent().remove();
                                });
                            } else {
                                layer.msg(data.msg, {icon:5, time: 2000})
                            }
                        },
                        error:function (data) {
                            layer.msg("网络错误，请稍后再试!", {icon:2, time:2000});
                        }
                    })

                });
            }
        </script>
    @endsection


