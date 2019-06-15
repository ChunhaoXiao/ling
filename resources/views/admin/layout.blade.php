<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>小程序lingerie后台管理</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	    <a class="navbar-brand" href="#">Navbar</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	    </button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		    <div class="navbar-nav">
		      <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
		      <a class="nav-item nav-link" href="#">Features</a>
		      <a class="nav-item nav-link" href="#">Pricing</a>
		      <a class="nav-item nav-link disabled" href="#">Disabled</a>
		    </div>
		</div>
    </nav>
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-2 text-center">
    			<ul class="list-group list-group-flush">
				  <a href="{{route('categories.index')}}" class="list-group-item">分类管理</a>
				  <a href="{{route('posts.index')}}" class="list-group-item">主题管理</a>
                  <a href="{{route('users.index')}}" class="list-group-item">用户管理</a>
				  
				</ul>
    		</div>
    		<div class="col-md-10">
    			@yield('content')
    		</div>
    	</div>
    </div>
    <script type="text/javascript">
    	$(function(){
    		$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
		    });

    		$("a[data-type='delete']").on('click', function(){
    			const url = $(this).data('url')
    			$.ajax({
    				url:url,
    				type:'delete',
    				success:function(res){
    					console.log(res)
    					location.reload();
    				}
    			})
    		})
    	})
    </script>
</body>
</html>