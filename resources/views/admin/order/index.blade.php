@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">

		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="#">Đơn hàng</a></li>
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
					<h3 class="card-title">Danh sách đơn hàng</h3>

					<div class="card-tools">
						<div>
							<form action="{{ route('product.index') }}" method="GET"
								class="input-group input-group-sm"
								style="width: 350px;">
								<input type="text" name="keyword"
									class="form-control float-right"
									placeholder="Tìm kiếm"
									value="{{ Request()->get('keyword') }}">

								<div class="input-group-append">
									<button type="submit" class="btn btn-default"><i
											class="fas fa-search"></i></button>
								</div>
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
								<th>Mã đơn hàng</th>
								<th>Tên người đặt</th>
								<th>Trạng thái</th>
								<th>Ngày đặt</th>
								<th>Lí do hủy</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($orders as $key => $order)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $order->code }}</td>
									<td>{{ $order->name }}</td>
									<td>
										<form action="" method="POST">
										@csrf										
											<select name="" id="" class="form-control change_status" data-id="{{ $order->id }}" {{ $order->status == App\Models\Order::ORDER_FINISH || $order->status == App\Models\Order::ORDER_CONFIRM_CANCEL ? 'disabled' : '' }}>
												@foreach (App\Models\Order::$status_text as $key => $value )
													<option class="status{{$key}}" value="{{$key}}" {{$order->status == $key ? 'selected' : ''}}>{{ $value }}</option>
												@endforeach
											</select>
										</form>
									</td>
									<td>{{ $order->created_at->format('h:i') }} | {{ $order->created_at->format('d/m/Y') }}</td>
									<td>{{ $order->reason }}</td>
									<td>
										<a href="{{ route('order.detail',$order->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Xem chi tiết"><i class="fa fa-eye"></i></a>
										@if ($order->status == App\Models\Order::ORDER_RETURN)
											<a onclick="Check(this.id)" id="{{ $order->code }}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Đồng ý hủy đơn hàng"><i class="fas fa-check"></i></a>
											<a onclick="Cancel(this.id)" id="{{ $order->code }}" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Từ chối hủy đơn success"><i class="fas fa-times"></i></a>
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
@endsection

@section('script-end')
	<script>
		$(document).ready(function(){
			$(function() {
				$('[data-bs-toggle="tooltip"]').tooltip()
			});

			$('.change_status').on('change',function(){
				var id = $(this).data('id');
				var status = $(this).val();
				var _token = $('input[name="_token"]').val();
				// alert(status);
				$.ajax({
					type: "POST",
					url: "{{ route('order.update') }}",
					data: {
						id:id,
						status:status,
						_token:_token,
					},
					success: function (data) {
						location.reload();
						toastr.success('Đã cập nhật trạng thái đơn hàng');
					}
				});

			});
		});

		function Check(id)
		{
			var id = id;
			var _token = $('input[name="_token"]').val();

			$.ajax({
				type: "POST",
				url: "{{ route('check') }}",
				data: {
					id:id,
					_token:_token
				},
				success: function (response) {
					location.reload();
					toastr.success('Xác nhận hủy đơn hàng');
				}
			});
		}

		function Cancel(id)
		{
			var id = id;
			var _token = $('input[name="_token"]').val();

			$.ajax({
				type: "POST",
				url: "{{ route('cancel') }}",
				data: {
					id:id,
					_token:_token
				},
				success: function (response) {
					location.reload();
					toastr.error('Xác nhận không hủy đơn hàng');
				}
			});
		}
	</script>
@endsection