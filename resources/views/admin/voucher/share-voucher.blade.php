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
					<h3 class="card-title">Phát Voucher : {{ $voucher->name }}</h3>
					<form action="{{ route('voucher.share-success',$voucher->code) }}" method="POST">
						@csrf
						<div class="card-tools" style="text-align: right;">
							<span id="choose_all" class="btn btn-primary">Chọn tất cả</span>
							<span id="unchoose_all" class="btn btn-danger">Bỏ chọn tất cả</span>
							<button type="submit" class="btn btn-success">Phát Voucher</button>
						</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body table-responsive p-0">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th class="text-center">Tên</th>
								<th class="text-center">Email</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($users as $user)
							<tr>
								<td><input class="choose" type="checkbox" name="user[]"
										value="{{ $user->id }}"></td>
								<td class="text-center">{{ $user->name }}</td>
								<td class="text-center">{{ $user->email }}</td>
							</tr>
							@endforeach
							</form>
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
var choose_all = document.getElementById('choose_all');
var unchoose_all = document.getElementById('unchoose_all');
var choose = document.getElementsByClassName('choose');

choose_all.addEventListener('click', () => {
	for (let index = 0; index < choose.length; index++) {
		choose[index].checked = true;

	}
});

unchoose_all.addEventListener('click', () => {
	for (let index = 0; index < choose.length; index++) {
		choose[index].checked = false;

	}
});
</script>
@endsection