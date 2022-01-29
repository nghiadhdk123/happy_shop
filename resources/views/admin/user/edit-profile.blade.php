@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">

		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item active">Chỉnh sửa thông tin</li>
				<li class="breadcrumb-item active">{{ $user->name }}</li>
			</ol>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.container-fluid -->
<!-- Content -->
<div class="container-fluid">
	<!-- Main row -->
	<div class="row main_row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Thông tin người dùng</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<div class="row row_2">
					<div class="col-8">
						<form role="form" action="{{ route('user.update-profile',$user->id) }}" method="POST" name="myForm">
							@csrf
							<div class="card-body">
								<div class="form-group">
									<label for="exampleInputEmail1">Tên</label><span
										class="requie">*</span>
									<input type="text" class="form-control" id=""
										name="name" placeholder="Tên người dùng"
										value="{{ $user->name }}">
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Biệt danh (Nếu
										có)</label>
									<input type="text" class="form-control"
										name="nickname"
										placeholder="Nhập biệt danh của bạn"
										value="{{ $user->userinfor->nickname }}">
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Giới
										tính</label>
									@foreach (App\Models\User::$gender_text as $key
									=> $value )
									<div class="form-check form-switch">
										<input class="form-check-input"
											type="radio"
											id="flexSwitchCheckDefault"
											name="gender" value="{{ $key }}"
											{{ $user->gender == $key ? 'checked' : '' }}>
										<label class="form-check-label"
											for="flexSwitchCheckDefault">{{ $value }}</label>
									</div>
									@endforeach
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Email 2 (Nếu
										có)</label>
									<input type="text" class="form-control"
										id="mail" name="email_2"
										placeholder="Nhập email 2 của bạn"
										value="{{ $user->userinfor->email_2 }}">
								</div>

								<div class="row">
									<div class="form-group col-6">
										<label for="exampleInputEmail1">Số điện
											thoại</label><span
											class="requie">*</span>
										<input type="text" class="form-control"
											id="" name="phone"
											placeholder="Số điện thoại người dùng"
											value="{{ $user->phone }}">
									</div>

									<div class="form-group col-6">
										<label for="exampleInputEmail1">Địa chỉ
										</label>
										<input type="text" class="form-control"
											id="" name="address"
											placeholder="Địa chỉ người dùng"
											value="{{ $user->address }}">
									</div>
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Link
										Facebook</label>
									<input type="text" class="form-control"
										id="mail" name="link_facebook"
										placeholder="Nhập link facebook của bạn"
										value="{{ $user->userinfor->link_facebook }}">
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Link
										Instagram</label>
									<input type="text" class="form-control"
										id="mail" name="link_instagram"
										placeholder="Nhập link instagram của bạn"
										value="{{ $user->userinfor->link_instagram }}">
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Người
										yêu</label>
									<input type="text" class="form-control"
										id="mail" name="lover"
										placeholder="Nhập tên ny của bạn"
										value="{{ $user->userinfor->lover }}">
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Ngày
										sinh</label>
									<input type="date" class="form-control"
										id="mail" name="date"
										value="{{ $user->userinfor->date }}">
								</div>
							</div>
							<!-- /.card-body -->

							<div class="card-footer">
								<a href="{{ route('user.show',$user->id) }}"
									class="btn btn-dark">Huỷ bỏ</a>
								<button type="submit" class="btn btn-success">Cập
									nhật</button>
							</div>
						</form>
					</div>
					<div class="col-4">
						<div class="fileinput-new thumbnail">
							@if($user->avatar_url)
							<img src="{{ $user->avatar_url }}" id="change_img"
								data-img="{{ $user->avatar_url }}">
							@else
							@if($user->avatar)
							<img src="{{ \Illuminate\Support\Facades\Storage::url($user->avatar) }}"
								id="change_img" data-img="{{ $user->avatar }}">
							@else
							<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/OOjs_UI_icon_userAvatar-constructive.svg/1024px-OOjs_UI_icon_userAvatar-constructive.svg.png"
								alt="" id="change_img">
							@endif
							@endif
						</div>
						<form action="{{ route('user.update-profile-avatar',$user->id) }}" method="POST" enctype='multipart/form-data'>
						@csrf
							<span class="btn btn-default btn-file">
								<span class="fileinput-new"> Chọn Ảnh Đại Diện </span>
								<input id="uploadFile" type="file" name="image">
							</span>
							<input type="submit" id="save" class="btn btn-primary success" value="Cập nhật">
							<input type="reset" id="cancel" class="btn btn-danger" value="Hủy">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
<style>
.row_2 {
	padding-top: 1%;
}

.thumbnail {
	width: 334px;
	height: 150px;
	display: inline-block;
	margin-bottom: 5px;
	overflow: hidden;
	text-align: center;
	vertical-align: middle;
	padding: 4px;
	line-height: 1.42857;
	background-color: #fff;
	border: 1px solid #ddd;
	border-radius: 4px;
}

.thumbnail>#change_img {
	max-height: 100%;
	display: block;
	max-width: 100%;
	height: auto;
	margin-left: auto;
	margin-right: auto;
}

.requie {
	color: red;
}

.btn-file > input {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    font-size: 23px;
    cursor: pointer;
    filter: alpha(opacity=0);
    opacity: 0;
    direction: ltr;
}

input[type=file] {
    display: block;
}

#cancel{
	width: 60px;
	display: none;
}

.success{
	width: 100px;
	display: none;
}

.hidden{
	/* opacity: 0; */
}

.ts{
	display: flex;
	align-items:center;
	position: relative;
}

.loc{
	width: 15px;
	height: 15px;
	display: inline-block;
	/* background:blue; */
	margin:0;
	position: absolute;
	right: 0;
	border: 1px solid rgba(0,0,0,.25);
   	border-radius: 50%;
}
</style>
@endsection

@section('script-end')
<script>

// var x = document.getElementsByClassName("loc");
// var v = document.getElementsByClassName('value');
// var k = document.getElementsByClassName('key');

// x.addEventListener('click',function(){
// 	alert("HELLO");
// });

// var count = 1;
// for(let i = 0;i<x.length;i++)
// {
// 	x[i].addEventListener('click',function(){
// 		count++;
// 		if(count%2  == 0)
// 		{
// 			x[i].style.backgroundColor = "#0d6efd";
// 			x[i].style.borderColor = "#0d6efd";
// 			v[i].checked = true;
// 			k[i].checked = true;
// 		}else{
// 			x[i].style.backgroundColor = "white";
// 			x[i].style.borderColor = "rgba(0,0,0,.25)";
// 			v[i].checked = false;
// 			k[i].checked = false;
// 		}
// 	});
// }


function previewImages() {
	var preview = document.querySelector('.gallere');
	var change_img = document.querySelector('#change_img');
	var save = document.querySelector('#save');
	var cancel = document.querySelector('#cancel');
	if (this.files) {
		[].forEach.call(this.files, readAndPreview);
	}

	function readAndPreview(file) {
		if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
			return alert(file.name + " is not an image");
		}
		var reader = new FileReader();
		reader.addEventListener("load", function() {
			// var image = new Image();
			// image.width = 150;
			// image.height = 150;
			// image.title = file.name;
			// image.src = this.result;
			// preview.appendChild(image);
			change_img.src = this.result;
			save.style.display = 'inline-block';
			cancel.style.display = 'inline-block';

			// console.log(t);
		});
		reader.readAsDataURL(file);
	}
}


document.querySelector('#uploadFile').addEventListener("change", previewImages);
</script>
@endsection