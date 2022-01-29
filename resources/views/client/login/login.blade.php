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

<body class="img js-fullheight" style="background-image: url(/frontend/auth/images/bg.jpg);">
	<section class="ftco-section" style="padding: 7em 0 0 0;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<a href="{{ route('home') }}"><h2 class="heading-section">E-SHOPPER</h2></a>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center">Have an account?</h3>
						<form action="{{ route('login.sigin') }}" class="signin-form" method="POST">
						@csrf
							<div class="form-group">
								<input type="text" name="email" class="form-control"
									placeholder="Email" required>
							</div>
							<div class="form-group">
								<input id="password-field" name="password" type="password"
									class="form-control" placeholder="Mật khẩu"
									required>
								<span toggle="#password-field"
									class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>
							<p>
								@if (session('status'))
                    							<span style="color:pink">{{ session('status') }}</span>
                						@endif
							</p>
							<div class="form-group">
								<button type="submit"
									class="form-control btn btn-primary submit px-3">Đăng nhập</button>
							</div>
							<div class="form-group d-md-flex">
								<div class="w-50">
									<label class="checkbox-wrap checkbox-primary">
										<a href="{{ route('register-client') }}" style="color:#fbceb5">Đăng kí</a> 
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#" style="color: #fff">Quên mật khẩu</a>
								</div>
							</div>
						</form>
						<p class="w-100 text-center">&mdash; Đăng nhập với &mdash;</p>
						<div class="social d-flex text-center">
							<a href="{{ url('auth/google') }}" class="px-2 py-2 mr-md-1 rounded"><span
									class="ion-logo-facebook mr-2"></span>
								Google+</a>
							<a href="{{ url('auth/facebook') }}" class="px-2 py-2 mr-md-1 rounded"><span
									class="ion-logo-facebook mr-2"></span>
								Facebook</a>
							<a href="{{ url('auth/github') }}" class="px-2 py-2 ml-md-1 rounded"><span
									class="ion-logo-twitter mr-2"></span>
								GitHub</a>
						</div>
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