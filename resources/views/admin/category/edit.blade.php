@extends('admin.layout.master')

@section('main-content')
	<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">
			
		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="{{ route('category.index') }}">Danh mục</a></li>
				<li class="breadcrumb-item active">Chỉnh sửa</li>
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
					<h3 class="card-title">Chỉnh sửa danh mục</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" action="{{ route('category.update',$category->id) }}" method="POST">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Tên danh mục</label><span
								class="requie">*</span>
							<input type="text" class="form-control" id="" name="name"
								placeholder="Tên danh mục" value="{{ $category->name }}">
								@error('name')
								<div><span class="requie">{{ $message }}</span></div>
								@enderror
						</div>

						<div class="form-group">
							<label>Danh mục cha</label>
							<select class="form-control select2" id="my-select" name="parent_id"
								style="width: 100%;" data-live-search="true">
								<option value="0" selected>Không có danh mục cha</option>
								@foreach ($parent as $parents)
									<option value="{{ $parents->id }}" {{ $category->parent_id == $parents->id ? 'selected' : '' }}>{{ $parents->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<a href="{{ route('category.index') }}" class="btn btn-dark">Huỷ bỏ</a>
						<button type="submit" class="btn btn-success">Cập nhật</button>
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
@section('script-end')
<script>
$(document).ready(function() {
	$('#my-select').selectpicker();
});
</script>
@endsection