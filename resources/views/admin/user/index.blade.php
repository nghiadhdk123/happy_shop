@extends('admin.layout.master')

@section('main-content')
<!-- Content Header -->
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Người dùng</a></li>
                    <li class="breadcrumb-item active">Danh sách</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Danh sách người dùng</h3>

                        <div class="card-tools">
                            <div >
			    <form action="{{ route('user.index') }}" method="GET" class="input-group input-group-sm" style="width: 350px;">
				<input type="text" name="keyword" class="form-control float-right" placeholder="Tìm kiếm" value="{{ Request()->get('keyword') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
			    </form>
                            </div>
                        </div>

			<div class="card-tools">
                            <div >
			    <form action="{{ route('user.index') }}" id="active" method="GET" class="input-group input-group-sm" style="width: 150px; margin-right:25px;">
				<select name="active" id="" class="form-control choose_active">
						    <option selected disabled>-- Chọn trạng thái --</option>
						    @foreach (App\Models\User::$status_text as $key => $value )
							    <option value="{{ $key }}">{{ $value }}</option>
						    @endforeach
					    </select>
			    </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Chức vụ</th>
                                <th>Quyền</th>
                                <th>Thời gian tạo</th>
                                <th class="text-center">Trạng thái</th>
				<th>Hoạt động</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
				@foreach ($user as $key => $users)
				<tr>
					<td class="pt-4">{{ $key+1 }}</td>
					<td class="pt-4">{{ $users->name }}</td>
					<td class="pt-4">{{ $users->email }}</td>
					<td class="pt-4">
						@if ($users->role == 0)
							<span class="badge badge-primary">{{ $users->role_text }}</span>
						@elseif($users->role == 1)
							<span class="badge badge-info">{{ $users->role_text }}</span>
						@else
							<span class="badge badge-danger">{{ $users->role_text }}</span>
						@endif
					</td>
					<td class="pt-4">
						@foreach ($users->permissions as $value)
							<span class="badge badge-primary">{{ $value->name }}</span>
						@endforeach
					</td>
					<td class="pt-4">{{ $users->created_at->format('h:i') }} | {{ $users->created_at->format('d/m/Y') }}</td>
					@if($users->role != App\Models\User::ADMIN)
					<td class="text-center mt-2 pt-4">
						@if ($users->is_active == 0)
							<a href="{{ route('user.locktoggle',$users->id) }}"> <i class="fa fa-lock text-dark"></i> </a>
						@else
							<a href="{{ route('user.locktoggle',$users->id) }}"> <i class="fa fa-unlock text-primary"></i> </a>
						@endif
					</td>
					@else
						<td class="text-center pt-4">
							<i class="fa fa-ban"></i>
						</td>
					@endif
					<td class="pt-4">
						@if($users->active == 1)
							Đang hoạt động
						@else
							@if(Carbon\Carbon::parse($users->time_login)->diffInMinutes() < 60)
								{{ Carbon\Carbon::parse($users->time_login)->diffInMinutes() }} phút trước
							@else
								@if (Carbon\Carbon::parse($users->time_login)->diffInHours() > 24)
									{{ Carbon\Carbon::parse($users->time_login)->diffInDays() }} ngày trước
								@else
									{{ Carbon\Carbon::parse($users->time_login)->diffInHours() }} giờ trước
								@endif
							@endif
						@endif
					</td>
					<td>
						<a href="{{ route('user.show',$users->id) }}" class="btn btn-dark btn-sm mt-2" data-bs-toggle="tooltip" data-placement="top" title="Xem chi tiết"><i class="fa fa-eye"></i></a>
						@if ((auth()->user()->hasAnyPermission(['edit user'])))
							<a href="{{ route('user.edit',$users->id) }}" class="btn btn-primary btn-sm mt-2" data-bs-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
						@endif
						@if ((auth()->user()->hasAnyPermission(['destroy user'])))
							<form id="for" action="{{ route('user.delete',$users->id) }}" method="POST">
								@method('delete')
								@csrf
								<a href="#" class="btn btn-danger btn-sm mt-2 delete-confirm" data-bs-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></a>
							</form>
						@endif
						@if ((auth()->user()->hasAnyPermission(['decentralization'])))
							<a href="{{ route('user.permission',$users->id) }}" class="btn btn-success btn-sm mt-2" data-bs-toggle="tooltip" data-placement="top" title="Quyền hạn"><i class="fas fa-sliders-h"></i></a>
						@endif
					</td>
                            	</tr>
				    @endforeach
                            </tbody>
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
	    #for{
		    display: inline;
	    }
    </style>
@endsection

@section('script-end')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
	$(document).ready(function() {

		$('.delete-confirm').click(function(event) {
			var form = $(this).closest("form");
			var name = $(this).data("name");
			event.preventDefault();
			swal({
					title: `Bạn có muốn xóa không?`,
					text: "Nếu bạn xóa nó, bạn sẽ không thể khôi phục lại được.",
					icon: "warning",
					buttons: ["Không", "Xóa"],
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						form.submit();
					}
				});
		});

		$(function() {
			$('[data-bs-toggle="tooltip"]').tooltip()
		});

		$('.choose_active').change(function(event) {
			event.preventDefault();
			$('#active').submit();
		});
	});
	</script>
@endsection