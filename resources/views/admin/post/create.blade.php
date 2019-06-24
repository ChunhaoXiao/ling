@extends('admin.layout')

@section('content')
    <p></p>
	<form @empty($post) action="{{route('posts.store')}}" @else action="{{route('posts.update', $post)}}" @endempty method="post" enctype="multipart/form-data">
		<div class="form-group col-md-6">
			<label for="">分类</label>
			<select name="category_id" class="form-control">
				@foreach($categories as $cate)
					<option {{isset($post) && $post->category_id == $cate->id?'selected': ''}} value="{{$cate->id}}">{{$cate->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-md-6">
			<label for="">标题</label>
			<input type="text" name="title" class="form-control" value="{{$post->title??''}}">
		</div>

		<div class="form-group col-md-6">
			<label for="">贴子类型</label>
			<select class="form-control" name="post_type">
				@foreach(App\Models\Post::$types as $key => $v)
					<option value="{{$key}}">{{$v}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-md-6">
			<label for="">价格</label>
			<input type="text" name="price" class="form-control" value="{{$post->price??0}}">
		</div>
		<div class="form-group col-md-6">
			<label for="">销量</label>
			<input type="text" name="sold_count" class="form-control" value="{{$post->sold_count??0}}">
		</div>

		<div class="form-group col-md-6">
			<label for="">vip专属</label>
			<div>
				<input type="radio" name="is_vip" value="1" {{!empty($post->is_vip) || !isset($post) ? 'checked' : ''}}>是
				&nbsp;&nbsp;&nbsp;&nbsp;
			    <input type="radio" name="is_vip" value="0" {{isset($post) && $post->is_vip == 0 ? 'checked': ''}}>否
			</div>
		</div>
		<div class="form-group col-md-6">
			<label for="">文字介绍</label>
			<textarea name="body" cols="30" rows="6" class="form-control">{{$post->body??''}}</textarea>
		</div>
		<div class="form-group col-md-6">
			<label for="">选择图片</label>
			<input type="file" name="pictures[]" class="form-control" multiple>
			@isset($post->pictures)
				<div id="pictures" class="row mt-3 ml-2">
					@foreach($post->pictures as $pic)
						<div class="mr-2">
							<input type="hidden" name="old_pictures[]" value="{{$pic->path}}">
							<img  src="{{asset('storage/'.$pic->path)}}" alt="" width="65" height="65">
						</div>
					@endforeach
				</div>
			@endisset
		</div>


		@csrf
		
		@isset($post)
			@method('PUT')
		@endisset
		<div class="form-group col-md-6">
			<button class="btn btn-primary">确定</button>
		</div>
	</form>
	 @include('admin.error')
	 <script type="text/javascript">
	 	$(function(){
	 		$("#pictures img").on('click', function(){
	 			$(this).parent().remove();
	 		})
	 	})
	 </script>
@endsection