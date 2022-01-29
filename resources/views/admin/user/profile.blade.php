@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">
			
		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item active">Thông tin</li>
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
					<div class="col-12 col-md-6 col-sm-12 img_user">
						@if($user->avatar_url)
						<img src="{{ $user->avatar_url }}"
							id="change_img" data-img="{{ $user->avatar_url }}">
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
					<div class="col-12 col-md-6 col-sm-12 text-sm-center text-md-left">
						<div class="row">
							<div class="col-12">
								<h2>{{ $user->name }} 
									@if ($user->gender == 0)
										<span> <i class="fa fa-mars" style="color:#009deb"></i> </span>
									@elseif ($user->gender == 1)
										<span> <i class="fa fa-venus" style="color:#ff70b8"></i> </span>
									@else
										<span> <i class="fa fa-transgender-alt"></i> </span>
									@endif
									
								</h2>
							</div>
							<div class="col-12" id="address">
								@if ($user->address)
									{{ $user->address }} 
								@else
									Đang cập nhật
								@endif
								
								<i class="fa fa-map-marker" style="color:gray"></i> 
							</div>
							<div class="col-12" data-bs-toggle="tooltip" data-placement="top" title="Biệt danh"><i class="fa fa-address-card icon_info" style="color:gray"></i>  
								@if ($user->userinfor->nickname)
									{{ $user->userinfor->nickname }}
								@else
									Đang cập nhật
								@endif
								
							</div>
							<div class="col-12" data-bs-toggle="tooltip" data-placement="top" title="Email"><i class="fa fa-envelope icon_info" style="color:gray"></i>  {{ $user->email }}</div>
							<div class="col-12" data-bs-toggle="tooltip" data-placement="top" title="Email thứ 2"><i class="fa fa-reply icon_info" style="color:gray"></i>  
								@if ($user->userinfor->email_2)
									{{ $user->userinfor->email_2 }}
								@else
									Đang cập nhật
								@endif
							</div>
							<div class="col-12" data-bs-toggle="tooltip" data-placement="top" title="Số điện thoại"><i class="fa fa-phone icon_info" style="color:gray"></i>
								@if ($user->phone)
									<a href="telto:{{ $user->phone }}">{{ $user->phone }}</a>
								@else
									Đang cập nhật
								@endif
							  	 
							</div>
							<div class="col-12" data-bs-toggle="tooltip" data-placement="top" title="Chức vụ"><i class="fa fa-user-circle icon_info" style="color:gray"></i>  {{ $user->role_text }} </div>
							<div class="col-12" data-bs-toggle="tooltip" data-placement="top" title="Đường dẫn tài khoản facebook"><i class="fab fa-facebook icon_info" style="color:gray"></i>  
								@if ($user->userinfor->link_facebook)
									<a href="{{ $user->userinfor->link_facebook }}">{{ $user->userinfor->link_facebook }}</a>
								@else
									Đang cập nhật
								@endif
								 
							</div>
							<div class="col-12" data-bs-toggle="tooltip" data-placement="top" title="Đường dẫn tài khoản instagram"><i class="fab fa-instagram icon_info" style="color:gray"></i>  
								@if ($user->userinfor->link_instagram)
									<a href="{{ $user->userinfor->link_instagram }}">{{ $user->userinfor->link_instagram }}</a>
								@else
									Đang cập nhật
								@endif
								 
							</div>
							<div class="col-12" data-bs-toggle="tooltip" data-placement="top" title="NY"><i class="fa fa-heart icon_info" style="color:gray"></i>
								@if ($user->userinfor->lover)
									{{ $user->userinfor->lover }} 
								@else
									Đang cập nhật
								@endif
							  
							</div>
							<div class="col-12" data-bs-toggle="tooltip" data-placement="top" title="Ngày sinh"><i class="fa fa-birthday-cake icon_info" style="color:gray"></i>  
								@if ($user->userinfor->date)
									{{ $user->userinfor->date }}
								@else
									Đang cập nhật
								@endif
								 
							</div>
						</div>
					</div>
				</div>
				@if ($user->id == Auth::user()->id)
				<div class="row row_footer">
					<div class="col-12 col_footer">
						<a href="{{ route('user.reset-password',$user->id) }}" class="btn btn-dark">Đổi mật khẩu</a>
						<a href="{{ route('user.edit-profile',$user->id) }}" class="btn btn-primary">Chỉnh sửa thông tin</a>
					</div>
				</div>
				@endif
				
			</div>
		</div>
	</div>
	<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
<style>
	#address{
		color:gray;
		font-size: 12px;
	}

	.row_2{
		padding: 5%;
	}

	#change_img{
		width: 300px;
    		height: 300px;
    		object-fit: cover;
    		border-radius: 50%;
	}

	.img_user{
		text-align:center;
	}

	.main_row{
		width: 70%;
   		margin: auto;
	}

	.icon_info{
		margin-right:2%;
	}

	.row_footer{
		background-color: transparent;
  		border-top: 1px solid rgba(0,0,0,.125);
    		padding: .75rem 1.25rem;
    		position: relative;
    		border-top-left-radius: .25rem;
    		border-top-right-radius: .25rem;
	}

	.col_footer{
		text-align:right;
	}
</style>
@endsection

@section('script-end')
	<script>
		$(document).ready(function(){
			$(function() {
				$('[data-bs-toggle="tooltip"]').tooltip()
			});
		});
	</script>
@endsection