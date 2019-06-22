<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	<style>
	html, body{
		height: 100%
    }
</style>
</head>
<body>
	<div class="container-fluid border h-100 bg-secondary">

		<div class="row align-items-center h-100">
			
			<div class="col-4 mx-auto">
				<h3 class="text-white text-center">管理员登录</h3>
				<form action="{{route('admin.login')}}" method="post">
					
					<div class="form-group">
						<label for="">用户名</label>
						<input type="text" class="form-control" name="name">
					</div>
					<div class="form-group">
						<label for="">密码</label>
						<input type="password" class="form-control" name="password">
					</div>
					@csrf
					<div class="form-group">
						<label for=""></label>
						<button class="btn btn-primary">确定</button>
					</div>
				</form>
		    </div>
	    </div>
    </div>
</body>
</html>