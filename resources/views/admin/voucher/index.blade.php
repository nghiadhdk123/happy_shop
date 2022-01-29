@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">

		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="#">Voucher</a></li>
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
					<h3 class="card-title">Danh sách Voucher</h3>

					<div class="card-tools">
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body table-responsive p-0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Tên voucher</th>
								<th>Mã voucher</th>
								<th class="text-center">Giảm</th>
								<th class="text-center">Trạng thái</th>
								<th>Ngày tạo</th>
								<th>Hạn sử dụng</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($vouchers as $key => $voucher)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $voucher->name }}</td>
								<td>{{ $voucher->code }}</td>
								<td class="text-center">{{ $voucher->percent }}%</td>
								<td class="text-center">
									@if ( Carbon\Carbon::now()->toDateString() > $voucher->expiry)
										Đã hết hạn sử dụng
									@else
										Còn hạn
									@endif

								</td>
								<td>{{ $voucher->created_at->format('d/m/Y') }}</td>
								<td>{{ Carbon\Carbon::parse($voucher->expiry)->format('d/m/Y') }}</td>
								<td>
									<form id="for" action="" method="POST">
										@csrf
										<a href="#" class="btn btn-danger delete-confirm btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></a>
									</form>
									@if ( Carbon\Carbon::now()->toDateString() <= $voucher->expiry)
										<a href="{{ route('voucher.share',$voucher->code) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Phát voucher cho người dùng"><i class="fa fa-gift"></i></a>
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
<script>
	$(function() {
		$('[data-bs-toggle="tooltip"]').tooltip()
	});
</script>
@endsection