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
                    <li class="breadcrumb-item active">Danh sách xóa</li>
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
                        <h3 class="card-title">Danh sách người dùng đã xóa</h3>
                            
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
                                <th>Thời gian tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
				@foreach ($user as $key => $users)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $users->name }}</td>
					<td>{{ $users->email }}</td>
					<td class="">
						@if ($users->role == 0)
							<span class="badge badge-primary">{{ $users->role_text }}</span>
						@elseif($users->role == 1)
							<span class="badge badge-info">{{ $users->role_text }}</span>
						@else
							<span class="badge badge-danger">{{ $users->role_text }}</span>
						@endif
					</td>
					<td>{{ $users->created_at->format('h:i') }} | {{ $users->created_at->format('d/m/Y') }}</td>
					<td>
						<a href="{{ route('user.restore',$users->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Khôi phục dữ liệu"><i class="fas fa-redo"></i></a>
						<form id="for" action="{{ route('user.destroy',$users->id) }}" method="POST">
							@csrf
							<a href="#">
								<img class="delete-confirm" src="/backend/dist/img/th ha ml.png" alt="" data-bs-toggle="tooltip" data-placement="top" title="Xóa">
							</a>	
						</form>
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

	    .delete-confirm{
		width: 40px;
		height: 40px;
		display: inline-block;
    		font-weight: 400;
    		color: #212529;
    		text-align: center;
    		vertical-align: middle;
    		-webkit-user-select: none;
    		-moz-user-select: none;
    		-ms-user-select: none;
   		 user-select: none;
    		background-color: transparent;
    		border: 1px solid transparent;
    		font-size: 1rem;
    		line-height: 1.5;
    		border-radius: .25rem;
    		transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
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