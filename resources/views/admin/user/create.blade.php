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
				<li class="breadcrumb-item"><a href="{{ route('user.index') }}">Người dùng</a></li>
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
					<h3 class="card-title">Tạo mới người dùng</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" action="{{ route('user.store') }}" method="POST">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Tên</label><span
								class="requie">*</span>
							<input type="text" class="form-control" id="" name="name"
								placeholder="Tên người dùng" value="{{ old('name') }}">
								@error('name')
								<div><span class="requie">{{ $message }}</span></div>
								@enderror
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label><span
								class="requie">*</span>
							<input type="email" class="form-control" id="" name="email"
								placeholder="Email người dùng" value="{{ old('email') }}">
								@error('email')
								<div><span class="requie">{{ $message }}</span></div>
								@enderror
						</div>
						<div class="row">
							<div class="form-group col-6">
								<label for="exampleInputEmail1">Số điện
									thoại</label><span class="requie">*</span>
								<input type="text" class="form-control" id=""
									name="phone" placeholder="Số điện thoại người dùng" value="{{ old('phone') }}">
									@error('phone')
									<div><span class="requie">{{ $message }}</span></div>
									@enderror
							</div>

							<div class="form-group col-6">
								<label for="exampleInputEmail1">Địa chỉ
									</label>
								<input type="text" class="form-control" id=""
									name="address" placeholder="Địa chỉ người dùng" value="{{ old('address') }}">
							</div>
						</div>

						<div class="form-group">
							<label>Quyền</label><span class="requie">*</span>
							<select class="form-control select2" id="my-select" name="role"
								style="width: 100%;" data-live-search="true">
								<option selected disabled hidden>--- Chọn quyền ---</option>
								@foreach (App\Models\User::$role_text as $key => $value)
									<option value="{{ $key }}">{{ $value }}</option>
								@endforeach
							</select>
						</div>
						@error('role')
						<div><span class="requie">{{ $message }}</span></div>
						@enderror
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<a href="{{ route('user.index') }}" class="btn btn-dark">Huỷ bỏ</a>
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

@section('script-end')
<script>
	$(document).ready(function() {
		$('#my-select').selectpicker({noneSelectedText: '--- Chọn quyền ---'});
	});
</script>
@endsection