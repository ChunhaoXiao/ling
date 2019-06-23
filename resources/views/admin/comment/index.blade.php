@extends('admin.layout')

@section('content')
	<table class="table table-bordered table-hover">
		<thead>
			
			<th>评论内容</th>
			<th>评论主题</th>
			<th>发布时间</th>
			<th>评论人</th>
			<th>操作</th>
		</thead>
		@foreach($datas as $v)
			<tr>
				<td>{{ $v->body }}</td>
				<td>{{ $v->post->title }}</td>
				<td>{{ $v->created_at }}</td>
				<td></td>
				<th><a data-type="delete" data-url="{{route('comments.destroy', $v)}}" href="javascript:;">删除</a></th>
			</tr>
		@endforeach
	</table>
@endsection