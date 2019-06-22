@extends('admin.layout')

@section('content')
	<p><a class="btn btn-primary" href="{{route('categories.create')}}">新增</a></p>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>用户名</th>
				<th>是否是vip</th>
				<th>会员到期时间</th>
				<th></th>
			</tr>
			@foreach($datas as $v)
				<tr>
					<td>{{$v->name}}</td>
					<td>{{$v->vip?'是':'否'}}</td>
					<td>{{$v->vip->end_at??''}}</td>
					
					<td><a data-toggle="modal" data-target="#setVip" class="text-dark" href="javascript:;" data-name="{{$v->name}}" >设置VIP会员</a> | <a class="text-dark" href="javascript:;" data-url="{{route('users.destroy', $v)}}" data-type="delete">删除</a></td>
				</tr>
			@endforeach
		</thead>
	</table>
	<p>{{ $datas->links() }}</p>


<!--模态框-->
<div class="modal fade" id="setVip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">设置vip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 

       	<div class="form-group">
       		<label for="">用户名:<strong></strong></label>
       		<div class="row">
       			<div class="col-6">
       				<input type="text" class="form-control" id="month">
       			</div>
       			<div class="col-auto"><span class="my-auto">个月</span></div>
       		</div>
			
       	</div>
		<span class="alert alert-danger"></span>
		<span class="alert alert-success"></span>
		
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary">确定</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(function(){
		$('#setVip').on('show.bs.modal', function (event) {

		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var name = button.data('name') // Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		 
		  var modal = $(this)
		  modal.find("strong").text(name)

		  modal.find(".alert-danger").text('').hide();
		  modal.find(".alert-success").text('').hide();
		  modal.find(".form-control").val(1)
		  modal.find("button").show()
		  //modal.find('.modal-title').text('New message to ' + recipient)
		  //modal.find('.modal-body input').val(recipient)
		  modal.find(".btn-primary").on('click', function(){
		  	var month = modal.find(".form-control").val()
		  	
		  	$.ajax({
		  		url:"{{route('vip.store')}}",
		  		data:{
		  			name:name,
		  			month:month
		  		},
		  		type:'POST',
		  		success:function(res){
		  			console.log(res)
		  			modal.find(".alert-success").text('操作成功').show();
		  			modal.find("button").hide();
		  			setTimeout(function(){
		  				$("#setVip").modal('hide')
		  				location.reload();
		  			}, 1000)
		  		},
		  		error:function(data){
		  			if(data.status == 422)
		  			{
		  				var obj = data.responseJSON.errors;
		  			    let key = Object.keys(obj)[0]
		  			    let msg = obj[key][0];
		  			    modal.find(".alert-danger").text(msg).show()
		  			}
		  			
		  		}
		  	});
		  })
        })
	})
</script>
@endsection