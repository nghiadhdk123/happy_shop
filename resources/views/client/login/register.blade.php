<!doctype html>
<html lang="en">

<head>
	<title>E-Shopper - login or sign up</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="/frontend/auth/css/style.css">

</head>
<style>
	.error{
		padding-left: 5%;
		font-weight:bold;
		color:pink;
	}
</style>
<body class="img js-fullheight" style="background-image: url(/frontend/auth/images/bg.jpg);">
	<section class="ftco-section" style="padding: 7em 0 0 0;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">E-SHOPPER</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center" style="font-size:20px">Đăng kí tài khoản E-SHOPPER</h3>
						<form action="{{ route('register') }}" class="signin-form" method="POST">
						@csrf
							<div class="form-group">
								<input type="text" name="name" class="form-control"
									placeholder="Họ và tên" value="{{ old('name') }}">
							</div>
							@error('name')
								<p class="error">{{ $message }}</p>
							@enderror
							<div class="form-group">
								<input type="text" name="email" class="form-control"
									placeholder="Email" value="{{ old('email') }}">
							</div>
							@error('email')
								<p class="error">{{ $message }}</p>
							@enderror
							<div class="form-group">
								<input type="text" name="phone" class="form-control"
									placeholder="Số điện thoại" value="{{ old('phone') }}">
							</div>
							@error('phone')
								<p class="error">{{ $message }}</p>
							@enderror
							<div class="form-group">
								<input id="password-field" name="password" type="password"
									class="form-control" placeholder="Mật khẩu">
								<span toggle="#password-field"
									class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>
							@error('password')
								<p class="error">{{ $message }}</p>
							@enderror
							<div class="form-group">
								<button type="submit"
									class="form-control btn btn-primary submit px-3">Đăng kí</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="/frontend/auth/js/jquery.min.js"></script>
	<script src="/frontend/auth/js/popper.js"></script>
	<script src="/frontend/auth/js/bootstrap.min.js"></script>
	<script src="/frontend/auth/js/main.js"></script>

</body>

</html>