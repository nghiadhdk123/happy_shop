@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">

		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="#">Vai trò</a></li>
				<li class="breadcrumb-item active">Danh sách cấp quyền</li>
			</ol>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.container-fluid -->
<!-- Content -->
<div class="container-fluid">
	<!-- Main row -->
	<div class="row">

		<div class="col-12">
			<div class="card">
				<form action="{{ route('user.add-permission-for-role',$user->id) }}" method="POST">
				@csrf
					<div class="card-header">
						<h3 class="card-title">Phần quyền cho {{ $user->role_text }} : {{ $user->name }}</h3>
						<select name="#" id="chosse-permission">
							<option value="0" selected disabled>------ ^-^ ------</option>
							<option value="1">Chọn tất cả</option>
							<option value="2">Bỏ chọn tất cả</option>
						</select>
						<button type="submit" class="btn btn-success">Lưu</button>
						<a href="{{ route('user.index') }}" class="btn btn-danger close-per">Đóng</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Tên quyền</th>
									<th>Mô tả quyền</th>
									<th class="text-center">Hành động</th>
								</tr>
							</thead>

							<tbody>
								@foreach ($permission as $key => $permissions)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $permissions->name }}</td>
									<td>{!! $permissions->description !!}</td>
									<td class="text-center">
										<!-- <input type="checkbox"> -->
										<label class="switch">
											<input type="checkbox"
												@foreach ($user->permissions as $value)
													@if($value->id == $permissions->id)
														checked
													@endif
												@endforeach
												name="permission[]"
												value="{{ $permissions->name }}"
												class="permission">
											<span class="slider round"></span>
										</label>
									</td>
								</tr>
								@endforeach
							</tbody>
				</form>
				</table>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
<style>
.switch {
	position: relative;
	display: inline-block;
	width: 40px;
	height: 20px;
}

/* Hide default HTML checkbox */
.switch input {
	opacity: 0;
	width: 0;
	height: 0;
}

/* The slider */
.slider {
	position: absolute;
	cursor: pointer;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: #ccc;
	-webkit-transition: .4s;
	transition: .4s;
}

.slider:before {
	position: absolute;
	content: "";
	height: 13px;
	width: 13px;
	left: 4px;
	bottom: 4px;
	background-color: white;
	-webkit-transition: .4s;
	transition: .4s;
}

input:checked+.slider {
	background-color: #2196F3;
}

input:focus+.slider {
	box-shadow: 0 0 1px #2196F3;
}

input:checked+.slider:before {
	-webkit-transform: translateX(20px);
	-ms-transform: translateX(20px);
	transform: translateX(20px);
}

/* Rounded sliders */
.slider.round {
	border-radius: 34px;
}

.slider.round:before {
	border-radius: 50%;
}

button {
	float: right;
}

.card-header{
	margin-bottom:2%;
}

#chosse-permission{
	margin-left: 20%;
    	height: 30px;
}

.close-per{
	float:right;
}
</style>
@endsection

@section('script-end')
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
	<script>
		$(document).ready(function() {
    			var oTable = $('#example').DataTable({
				"language": {
    					"info": "Số trang _PAGE_ của _PAGES_",
					"lengthMenu": "Số bản ghi _MENU_",
					"search": "Tìm kiếm:",
					// "emptyTable": "Không có quyền nào ",
					"zeroRecords": "Không có quyền nào như trên tìm kiếm",
					oPaginate: {
						sNext: '<i class="fa fa-forward"></i>',
						sPrevious: '<i class="fa fa-backward"></i>',
						sFirst: '<i class="fa fa-step-backward"></i>',
						sLast: '<i class="fa fa-step-forward"></i>'
    					}
					
  				},
				"lengthMenu": [[50, 100 , 250 , 500], [50, 100 , 250 , 500 ]]
			});

			var allPages = oTable.cells( ).nodes( );
			var permission = document.getElementsByClassName('permission');
			var select = document.getElementById('chosse-permission');

			select.addEventListener('change', () => {
				var permission_value = select.options[select.selectedIndex].value;
				
				if(permission_value == 1)
				{
					// alert("CTT");
					for(var i = 0 ; i<permission.length ; i++)
					{
						// permission[i].checked = true;
						$('input[type="checkbox"]', allPages).prop('checked', true);
					}
				}else{
					for(var i = 0 ; i<permission.length ; i++)
					{
						// permission[i].checked = false;
						$('input[type="checkbox"]', allPages).prop('checked', false);
					}
				}
			});
		});
	</script>
@endsection