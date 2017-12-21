@extends('admin.layout.main')
@section('title')登陆@endsection
@section('content')
	<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog</h1>
		<h2>欢迎使用博客管理平台-登陆</h2>
		<div class="result_wrap">
			<div class="result_title">
				@if(count($errors)>0)
					<div class="mark" style="margin-left: 41%;margin-right: 43%; width: 216px;">
					{{--<div class="mark" style="position:absolute;left: 50%;top: 70%;margin-left: -600px;margin-top: -250px;width: 1200px;height: 100px;line-height: 100px;font-size: 36px;text-align: center;">--}}
						@if(is_object($errors))
							@foreach($errors->all() as $error)
								<p>{{$error}}</p>
							@endforeach
						@else
							<p>{{$errors}}</p>
						@endif
					</div>
				@endif
			</div>
		</div>
		<div class="form">
			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
						<input type="email" name="email" class="text" placeholder="请输入邮箱" value="{{ old('email') }}"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="password" class="text" placeholder="请输入密码6-20位数字或者字母" value="{{ old('password') }}"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code" placeholder="请输入验证码"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{route('viewVerifyCode')}}" alt="" class="imgcode" >
					</li>
					<li>
						<input type="checkbox" name="rememberme" value="1"/>记住我
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>

				</ul>
			</form>
			<div style="margin-left: 0%; width: 240px;">
				<input type="button" value="还没有账号？立即注册" style="width: 240px" onclick="window.location.href='{{route('viewRegister')}}'"/>
			</div>

			<p><a href="#">返回首页</a>
				&copy; 2016 Powered by <a href="http://www.magicsea.com:8081/admin/index" target="_blank">http://www.houdunwang.com</a>
			</p>
		</div>
	</div>
	<script>
        $('.imgcode').hover(function(){
            $(this).attr('title','看不清，点击切换');
        }).click(function(){
            $(this).attr('src','{{route('viewVerifyCode')}}?id=' + Math.random());
        });
	</script>
	</body>
@endsection
