<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('admin/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('admin/font/css/font-awesome.min.css')}}">
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog</h1>
		<h2>欢迎使用博客管理平台</h2>
		<div class="form">
            @if(is_object($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><p style="color:red">{{ $error }}</p></li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p style="color:red">{{$errors}}</p>
            @endif
            @if(session('msg'))
            <p style="color:red">{{session('msg')}}</p>
            @endif
			<form action="{{route('doLogin')}}" method="post">
                {{csrf_field()}}
				<ul>
					<li>
					<input type="text" name="username" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="password" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{captcha_src('default')}}" alt="验证码" title="点击图片刷新验证码" onclick="this.src ='{{captcha_src()}}?'+Math.random() ">
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
		</div>
	</div>
</body>
</html>
