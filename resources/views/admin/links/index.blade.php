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
        <form action="#" method="post">
            <div class="result_wrap">
                <!--快捷导航 开始-->
                <div class="result_content">
                    <div class="short_wrap">
                        <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>新增链接</a>
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
                            <th class="tc">链接名称</th>
                            <th class="tc">链接说明</th>
                            <th class="tc">链接地址</th>
                            <th class="tc">操作</th>
                        </tr>
                        @foreach($data as $k => $v)
                            <tr>
                                <td class="tc">
                                    <input type="text"  value="{{$v->links_order}}" onchange="changeOrder(this, {{$v->links_id}})">
                                </td>
                                <td class="tc">{{$v->links_id}}</td>
                                <td class="tc">
                                    <a href="#" style="float: none;">{{$v->links_name}}</a>
                                </td>
                                <td class="tc">{{$v->links_title}}</td>
                                <td class="tc">{{$v->links_url}}</td>
                                <td class="tc">
                                    <a href="{{url('admin/links/'.$v->links_id.'/edit')}}" style="float: none;"><i class="fa fa-fw fa-edit"></i>修改</a>
                                    <a href="javascript:void(0)" style="float: none;" onclick="del(this, {{$v->links_id}})"><i class="fa fa-fw fa-trash"></i>删除</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="page_list" style="text-align: center">
                        {{$data->render()}}
                    </div>
                </div>
            </div>
        </form>
        <script>
            function changeOrder(obj, id) {
                orders = $(obj).val();
                $.ajax({
                    url : "{{url('admin/links/order')}}",
                    method: "post",
                    dataType: "json",
                    data: {
                        _token : "{{csrf_token()}}",
                        order : orders,
                        links_id : id
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
                        url : "{{url('admin/links/')}}/"+id,
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


