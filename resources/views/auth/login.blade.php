<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
		integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
	html,body{
		padding: 0;
		margin: 0;
	}

	*{
		padding: 0;
		margin: 0;
	}

	#wrapped{
		width: 100%;
		min-height: 100vh;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	#img_login{
		width: 55%;
		min-height: 100vh;
		background-image: url('/auth/yale.jpg');
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		position: relative;
	}

	#img_login::before{
		content: '';
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0;
		left: 0;
		background: rgba(0, 0, 0, 0.1);
	}

	#form_login{
		width: 45%;
		min-height: 100vh;
		background-color: #f7f7f7;
	}

	img{
		width: 100%;
	}

	#form{
		width: 100%;
    	display: flex;
    	flex-direction: column;
    	justify-content: center;
    	align-items: center;
	}

	input{
		width: 80%;
    	height: 50px;
    	font-size: 15px;
    	padding-left: 10px;
    	margin-bottom: 20px;
    	border: 0.5px solid #e6e6e6;
    	border-radius: 10px;
    	background-color: #f7f7f7;
    	outline: none;
	}

	input:focus {
		border: 1px solid #0000ff63;
	}

	button{
		width: 80%;
    	height: 50px;
    	font-weight: 500;
    	font-size: 18px;
    	color: white;
    	border-radius: 7px;
    	margin-top: 15px;
    	background: #6675df;
    	text-transform: uppercase;
    	white-space: 1px;
    	border: none;
    	cursor: pointer;
    	transition: 0.4s;
	}

	button:hover{
		background-color: gray;
	}
</style>
<body>
    <div id="wrapped">
		<div id="img_login">
			
		</div>
		<div id="form_login">
			<img src="/auth/logo_shop.png" alt="">
			<form action="{{ route('login.sigin') }}" id="form" method="POST">
            		@csrf
				<input type="text" id="account" placeholder="Email" name="email">
				<input type="password" id="password" placeholder="Mật khẩu" name="password">
                	@if (session('status'))
                    		<span style="color:red">{{ session('status') }}</span>
                	@endif
				<button type="submit">Đăng nhập</button>
			</form>
		</div>
	</div>

<script src="/backend/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
		integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
@if(Session::has('warning'))
<script>
toastr.error("{!! Session::get('warning') !!}");
</script>
@endif
@if(Session::has('success'))
<script>
toastr.success("{!! Session::get('success') !!}");
</script>
@endif

