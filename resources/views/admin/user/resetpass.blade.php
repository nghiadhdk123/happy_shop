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
				<li class="breadcrumb-item active">Thay đổi mật khẩu</li>
				<li class="breadcrumb-item active">{{ $user->name }}</li>
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
					<h3 class="card-title">Thay đổi mật khẩu</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" action="{{ route('user.update-new-password',$user->id) }}"
					method="POST">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Mật khẩu cũ</label><span
								class="requie">*</span>
							<input type="password" class="form-control" name="old_password"
								placeholder="Nhập mật khẩu hiện tại"
								value="{{ old('old_password') }}">
							@error('old_password')
							<span style="font-size: 13px;color: red;">{{ $message }}</span>
							@enderror
							@if(Session('error_pass'))
							<span
								style="font-size: 13px;color: red;">{{ Session('error_pass') }}</span>
							@endif

						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Mật khẩu mới</label><span
								class="requie">*</span>
							<input type="password" class="form-control" name="password"
								placeholder="Nhập mật khẩu mới" id="password">
							@error('password')
							<span style="font-size: 13px;color: red;">{{ $message }}</span>
							@enderror
							@if(Session('same_pass'))
							<span
								style="font-size: 13px;color: red;">{{ Session('same_pass') }}</span>
							@endif

						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Xác thực mật khẩu</label><span
								class="requie">*</span>
							<input type="password" class="form-control"
								name="password_confirmation"
								placeholder="Nhập mật khẩu xác thực"
								id="password_confirmation">
							@error('password_confirmation')
							<span style="font-size: 13px;color: red;">{{ $message }}</span>
							@enderror
						</div>
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<a href="{{ route('user.show',Auth::user()->id) }}" class="btn btn-dark">Huỷ bỏ</a>
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

#mail {
	cursor: not-allowed;
}
</style>
@endsection