@extends('admin.layout')

@section('content')
    <p></p>
	<form @empty($category) action="{{route('categories.store')}}" @else action="{{route('categories.update', $category)}}" @endempty method="post" enctype="multipart/form-data">
		<div class="form-group col-md-6">
			<label for="">分类名称</label>
			<input type="text" name="name" class="form-control" value="{{$category->name??''}}">
		</div>
		<div class="form-group col-md-6">
			<label for="">图标</label>
			<input  name="icon" type="file">
			@isset($category->icon)
			<div>
				<img src="{{asset('storage/'.$category->icon)}}" width="100" height="100">
			</div>
			@endisset
		</div>
		<div class="form-group col-md-6">
			<label for="">排序</label>
			<input type="number" name="order" class="form-control" value="{{$category->order??0}}">
		</div>
		<div class="form-group col-md-6">
			<label for="">是否显示</label>
			<div>
				<input type="radio" name="is_show" value="1" checked="checked">是
			    <input type="radio" name="is_show" value="0">否
			</div>
		</div>
		@csrf
		@isset($category)
		@method('PUT')
		@endisset
		<div class="form-group col-md-6">
			<button class="btn btn-primary">确定</button>
		</div>
	</form>
@endsection