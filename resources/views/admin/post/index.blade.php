@extends('admin.layout')

@section('content')
	<p><a class="btn btn-primary" href="{{route('posts.create')}}">新增</a></p>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>标题</th>
				<th>价格</th>
				<th>销量</th>
				<th>分类</th>
				<th>图片数量</th>
				<th>是否VIP</th>
				<th>时间段</th>
				<th>添加时间</th>
				<th></th>
			</tr>
			@foreach($datas as $v)
				<tr>
					<td>{{$v->title}}</td>
					<td>{{$v->price}}</td>
					<td>{{$v->sold_count}}</td>
					<td>{{$v->category->name}}</td>
					<td>{{$v->pictures_count}}</td>
					<td>{{$v->is_vip?'是':'否'}}</td>
					<td></td>
					<td>{{$v->created_at}}</td>
					<td><a href="{{route('posts.edit', $v)}}">修改</a> | <a href="javascript:;" data-url="{{route('posts.destroy', $v)}}" data-type="delete">删除</a></td>
				</tr>
			@endforeach
		</thead>
	</table>
@endsection