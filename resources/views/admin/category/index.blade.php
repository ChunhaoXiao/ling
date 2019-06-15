@extends('admin.layout')

@section('content')
	<p><a class="btn btn-primary" href="{{route('categories.create')}}">新增</a></p>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>分类名称</th>
				<th>图标</th>
				<th>排序</th>
				<th>是否启用</th>
				<th></th>
			</tr>
			@foreach($datas as $v)
				<tr>
					<td>{{$v->name}}</td>
					<td>@isset($v->icon)<img src="{{asset('storage/'.$v->icon)}}" width="100" height="100">@endisset</td>
					<td>{{$v->order}}</td>
					<td>{{$v->is_show}}</td>
					<td><a href="{{route('categories.edit', $v)}}">修改</a> | <a href="javascript:;" data-url="{{route('categories.destroy', $v)}}" data-type="delete">删除</a></td>
				</tr>
			@endforeach
		</thead>
	</table>
@endsection