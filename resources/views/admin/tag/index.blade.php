@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">

		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="#">Thẻ</a></li>
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
					<h3 class="card-title">Danh sách thẻ bài viết</h3>

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
								<th>Tên thẻ</th>
								<th class="text-center">Người tạo</th>
								<th class="text-center">Trạng thái</th>
								<th>Ngày tạo</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tags as $key => $tag)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $tag->name }}</td>
								<td class="text-center">{{ $tag->user->name }}</td>
								<td class="text-center">
									<form action="">
									@csrf
										@if ($tag->status == 0)
											<a class="status" data-id="{{$tag->id}}" data-bs-toggle="tooltip" data-placement="top" title="Ấn để ẩn"><i class="fas fa-moon" ></i></a>
										@else
											<a class="text-warning status" data-id="{{$tag->id}}" data-bs-toggle="tooltip" data-placement="top" title="Ấn để hiển thị"><i class="fas fa-sun"></i></a>
										@endif
									</form>
									
								</td>
								<td>{{ $tag->created_at->format('d/m/Y') }}</td>
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
	.status{
		cursor: pointer;
	}
</style>
@endsection

@section('script-end')
	<script>

		$(document).ready(function () {
			$('.status').click(function(){
				var id = $(this).data('id');
				var _token = $('input[name="_token"]').val();

				$.ajax({
					type: "POST",
					url: "{{ route('tag.toggle') }}",
					data: {
						id:id,
						_token:_token,
					},
					success: function (data) {
						location.reload();
						toastr.success('Cập nhật trạng thái thành công');
					}
				});
			});
		});
		$(function() {
			$('[data-bs-toggle="tooltip"]').tooltip()
		});
	</script>	
@endsection