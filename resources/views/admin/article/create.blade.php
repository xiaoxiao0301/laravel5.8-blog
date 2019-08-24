@extends('layout.admin')
@section('content')
    <style>
        .edui-default{line-height: 28px;}
        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
        {overflow: hidden; height:20px;}
        div.edui-box{overflow: hidden; height:22px;}
    </style>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 添加文章
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
                <a href="{{url('admin/article')}}"><i class="fa fa-plus"></i>文章列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/article')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="100"><i class="require">*</i>文章分类：</th>
                    <td>
                        <select name="art_cate_id">
                            @foreach($data as $k => $v)
                                <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章标题：</th>
                    <td>
                        <input type="text" class="lg"  name="art_title">
                        <span><i class="fa fa-exclamation-circle red"></i>文章关键字必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章关键字：</th>
                    <td>
                        <textarea name="art_tag" id="art_tag"></textarea>
                    </td>
                </tr>

                <tr>
                    <th>文章描述：</th>
                    <td>
                        <textarea name="art_description" id="art_description"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>文章编辑：</th>
                    <td>
                        <input type="text" name="art_author">
                    </td>
                </tr>
                <tr>
                    <th>文章缩略图：</th>
                    <td>
                        <div id="uploader-demo">
                            <!--用来存放item-->
                            <div id="fileList" class="uploader-list"></div>
                            <div id="filePicker">选择图片</div>
                        </div>
                        <div id="show_img" style="display:none;">
                            <img id="thumb_img" src="" alt="图片" height="100px">
                        </div>
                        <input type="hidden" name="art_thumb">
                    </td>
                </tr>
                <tr>
                    <th>文章内容:</th>
                    <td>
                        <textarea name="art_content" id="art_content"></textarea>
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
        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('art_content',{initialFrameWidth:1000,initialFrameHeight:600,autoHeightEnabled: true});

        // 初始化Web Uploader
        var $list = $("#fileList");
        var thumbnailWidht = 100;
        var thumbnailHeight = 100;
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            formData:{
                _token: "{{csrf_token()}}"
            },
            // swf文件路径
            swf: "{{asset('admin/webuploader/Uploader.swf')}}",

            // 文件接收服务端。
            server: "{{url('admin/files')}}",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id : '#filePicker',
                multiple: false
            },
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                $percent = $li.find('.progress span');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<p class="progress"><span></span></p>')
                    .appendTo( $li )
                    .find('span');
            }

            $percent.css( 'width', percentage * 100 + '%' );
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file, response) {
            var imgurl = response.fileName;
            $('#thumb_img').attr('src',imgurl);
            $("input[name='art_thumb']").val(imgurl);
            $('#show_img').css('display','block');
            $( '#'+file.id ).addClass('upload-state-done');
        });

        // 文件上传失败，显示上传出错。
        uploader.on( 'uploadError', function( file, response) {
            var fileerror = response.error;

            var $li = $( '#'+file.id ),$error = $li.find('div.error');

            // 避免重复创建
            if ( !$error.length ) {
                $error = $('<div class="error"></div>').appendTo( $li );
            }

            $error.text('上传失败'+fileerror);
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').remove();
        });
    </script>
@endsection
