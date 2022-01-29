@extends('client.layout.master')


@section('main-content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
		</div>
		<!--/breadcrums-->

		<div class="register-req">
			<marquee behavior="alternate" direction="right" scrolldelay="1">Xin chào bạn ! Đây là thông tin tài khoản của bạn</marquee>
		</div>
		<!--/register-req-->

		<div class="shopper-informations">
			<div class="row">
				<div class="col-sm-3">
					<div class="order-message">
						<p>Câu khuyết danh</p>
						<textarea name="message"
								placeholder="Người không chơi là người thắng , người chơi là người thắng"
								rows="16" disabled></textarea>
					</div>
				</div>
				<div class="col-sm-5 clearfix">
					<div class="bill-to">
						<p>Thông tin cá nhân</p>
						<div class="form-one">
							<form action="{{ route('update-profile-client',$user->id) }}" method="POST">
							@csrf
								<input type="text" name="name" placeholder="Thêm họ tên" class="input-form" value="{{ $user->name }}" disabled>
								<input type="hidden" name="name" placeholder="Thêm họ tên" class="input-form-hidden" value="{{ $user->name }}">
								<input type="text" name="nickname" placeholder="Thêm biệt danh" class="input-form" value="{{ $user->userInfor->nickname }}" disabled>
								<input type="hidden" name="nickname" placeholder="Thêm biệt danh" class="input-form-hidden" value="{{ $user->userInfor->nickname }}">
								<input type="text" name="phone" placeholder="Thêm số điện thoại" class="input-form" value="{{ $user->phone }}" disabled>
								<input type="hidden" name="phone" placeholder="Thêm số điện thoại" class="input-form-hidden" value="{{ $user->phone }}">
								<input type="text" name="address" placeholder="Thêm địa chỉ" class="input-form" value="{{ $user->address }}" disabled>
								<input type="hidden" name="address" placeholder="Thêm địa chỉ" class="input-form-hidden" value="{{ $user->address }}">
								<input type="text" name="lover" placeholder="Thêm tên ny" class="input-form" value="{{ $user->userInfor->lover }}" disabled>
								<input type="hidden" name="lover" placeholder="Thêm tên ny" class="input-form-hidden" value="{{ $user->userInfor->lover }}">
								<input type="date" name="date" value="{{ $user->userInfor->date }}">
								@foreach (App\Models\User::$gender_text as $key => $value)
									<input class="put-gender" type="radio" name="gender" value="{{ $key }}" {{ $user->gender == $key ? 'checked' : '' }}> {{ $value }}
								@endforeach
								<button type="submit" class="cqEaiM">Lưu thay đổi</button>
							</form>
						</div>
						<div class="form-two">
									<a class="btn btn-primary updated-form" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
									<a class="btn btn-primary updated-form" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
									<a class="btn btn-primary updated-form" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
									<a class="btn btn-primary updated-form" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
									<a class="btn btn-primary updated-form" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="order-message">
						<p>Thông tin khác</p>
						<div class="row_1">
							<div class="col-1">
								<img src="https://frontend.tikicdn.com/_desktop-next/static/img/account/email.png" alt="">
							</div>
							<div class="col-2">
								<p>Địa chỉ Email</p>
								<p>{{ $user->email }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
	.form-one{
		width: 70%;
	}

	.form-two{
		width: 20%;
		display:flex;
		flex-direction:column;
	}

	.updated-form{
		padding:10px;
		margin-bottom: 10px;
	}

	.btn.btn-primary {
		margin-top: 0px !important;
	}

	.info{
		margin: 0;
	}

	.input-form{
		outline:none;
	}

	.cqEaiM{
		border: 0px;
		width: 60%;
    		height: 40px;
		margin:auto;
    		border-radius: 4px;
    		color: rgb(255, 255, 255);
    		font-size: 14px;
    		background-color: rgb(11, 116, 229);
    		cursor: pointer;
		display: block;
	}

	.row_1{
		display: flex;
	}

	.col-1{
		width: 15%;
		text-align:right;
	}

	.col-2{
		width: 85%;
	}

	.col-1>img{
		width: 24px;
		height: 24px;
	}

	.col-2 p{
		font-size:15px;
		margin:0;
		padding-left: 3%;
	}

	.put-gender{
		width: 5% !important;
	}

	#cart_items{
		margin-bottom:5%;
	}
</style>
<!--/#cart_items-->
@endsection

@section('script-end')
	<script>
		$(document).ready(function () {
			var input = document.getElementsByClassName('input-form');
			var update = document.getElementsByClassName('updated-form');
			var hidden = document.getElementsByClassName('input-form-hidden');

			// console.log(input.length);
			// console.log(update.length);

			for(let i = 0 ; i < update.length ; i++)
			{
				update[i].addEventListener('click' , () => {
					input[i].disabled = false;
					input[i].style.outline = '1px solid gray';
					hidden[i].disabled = true;
				});
			}

			$(function () {
  				$('[data-toggle="tooltip"]').tooltip()
			});
		});
	</script>
@endsection