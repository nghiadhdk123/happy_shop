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
				<li class="breadcrumb-item"><a href="{{ route('category.index') }}">Voucher</a></li>
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
					<h3 class="card-title">Tạo mới mã Voucher</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" action="{{ route('voucher.store') }}" method="POST">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Tên voucher</label><span
								class="requie">*</span>
							<input type="text" class="form-control" id="" name="name"
								placeholder="Tên voucher" value="{{ old('name') }}">
								@error('name')
								<div><span class="requie">{{ $message }}</span></div>
								@enderror
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Mã voucher</label><span
								class="requie">*</span>
							<input type="text" class="form-control" id="code_voucher_disabled" name="code" disabled>
							<input type="hidden" class="form-control" id="code_voucher" name="code">
						</div>

						<div class="form-group" id="form_giam_phan_tram">
							<label for="exampleInputEmail1">Số phần trăm giảm</label><span
								class="requie">*</span>
							<input type="text" class="form-control" id="giam_phan_tram" name="percent"
								placeholder="Số phần trăm giảm" value="{{ old('percent') }}">
								@error('percent')
								<div><span class="requie">{{ $message }}</span></div>
								@enderror
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Hạn sử dụng</label><span
								class="requie">*</span>
							<input type="date" class="form-control" id="" name="expiry"
								value="{{ old('expiry') }}">
							@error('expiry')
							<div><span class="requie">{{ $message }}</span></div>
							@enderror
							@if(Session('error_time'))
								<div><span class="requie">{{ Session('error_time') }}</span></div>
							@endif
								
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

@section('script-end')
	<script>
		var code_voucher = document.getElementById('code_voucher');
		var code_voucher_disabled = document.getElementById('code_voucher_disabled');
		const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

		function generateString(length) {
			let result = ' ';
			const charactersLength = characters.length;
			for ( let i = 0; i < length; i++ ) {
				result += characters.charAt(Math.floor(Math.random() * charactersLength));
			}

			return result;
		}

		console.log(generateString(5));

		code_voucher_disabled.value = generateString(10);
		code_voucher.value = code_voucher_disabled.value;
	</script>
	
@endsection