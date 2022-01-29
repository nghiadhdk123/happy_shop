<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
</head>
<body>
	<h3>Chào mừng {{ $name }} đến với MyShop</h3>

	<h3>MyShop đã tạo cho {{ $name }} một tài khoản để truy cập vào MyShop:</h3>
	<p>Tài khoản : {{ $email }}</p>
	<p>Mật khẩu : {{ $password }}</p>
	<p>Đăng nhập tại : </p> <a href="{{ route('login') }}"> MyShop </a>
</body>
</html>