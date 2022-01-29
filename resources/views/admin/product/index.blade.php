@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">

		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
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
					<h3 class="card-title">Danh sách sản phẩm</h3>

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
								<th>Tên sản phẩm</th>
								<th>Danh mục</th>
								<th style="width:100px" class="text-center">Số lượng</th>
								<th style="width:150px">Giá gốc</th>
								<th style="width:150px">Người tạo</th>
								<th style="width:100px">Trạng thái</th>
								<th>Ngày tạo</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($product as $key => $value)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $value->name }}</td>
								<td>
									@if ($value->category_id == 0)
									Không có danh mục
									@else
									{{ $value->category->name }}
									@endif
								</td>
								<td class="text-center">{{ $value->quantity }}</td>
								<td>{{ number_format($value->origin_price) }} VNĐ</td>
								<td>{{ $value->user->name }}</td>
								<td>
									@if($value->status == 0)
									<span class="badge badge-primary">{{ $value->status_text }}
									</span>
									@elseif($value->status == 1)
									<span class="badge badge-dark">{{ $value->status_text }}
									</span>
									@else
									<span
										class="badge badge-danger">{{ $value->status_text }}</span>
									@endif
								</td>
								<td>{{ $value->created_at->format('d/m/Y') }}</td>
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