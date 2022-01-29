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
				<li class="breadcrumb-item"><a href="{{ route('category.index') }}">Danh mục</a></li>
				<li class="breadcrumb-item active">Tạo mới</li>
			</ol>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.container-fluid -->
<!-- Content -->
<div class="container-fluid">
	<!-- Main row -->
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Tạo mới thẻ bài viết</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" action="{{ route('tag.store') }}" method="POST">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Tên thẻ</label><span
								class="requie">*</span>
							<input type="text" class="form-control" id="" name="name"
								placeholder="Tên thẻ" value="{{ old('name') }}">
								@error('name')
								<div><span class="requie">{{ $message }}</span></div>
								@enderror
						</div>
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<a href="{{ route('category.index') }}" class="btn btn-dark">Huỷ bỏ</a>
						<button type="submit" class="btn btn-success">Tạo mới</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.row (main row) -->
</div><!-- /.container-fluid -->

<style>
.requie {
	color: red;
}
</style>
@endsection