<header id="header">
	<!--header-->
	<div class="header_top">
		<!--header_top-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href="#"><i class="fa fa-phone"></i> +84 904 373 670</a></li>
							<li><a href="#"><i class="fa fa-envelope"></i>trandinhnghia555@gmail.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/header_top-->

	<div class="header-middle">
		<!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="logo pull-left">
						<a href="{{ route('home') }}"><img src="/frontend/images/home/logo.png"
								alt="" /></a>
					</div>
				</div>
				<div class="col-sm-10">
					<div class="shop-menu pull-right">
						<ul class="nav navbar-nav">
							<li><a href="{{ route('cart') }}" class="{{ Route::is('cart') ? 'active' : '' }}"><i class="fa fa-shopping-cart"></i>
									Giỏ hàng của tôi</a></li>
							@if (Auth::user())
								<li><a href="{{ route('my-order',Auth::user()->id) }}" class="{{ Route::is('my-order') ? 'active' : '' }}"><i class="fa fa-truck"></i>
									Theo dõi đơn hàng</a></li>
								<li><a href="{{ route('my-voucher',Auth::user()->id) }}" class="{{ Route::is('my-voucher') ? 'active' : '' }}"><i class="fa fa-gift"></i>
									Mã giảm giá của tôi (1)</a></li>
							@endif
							
							@if (Auth::user())
								<li><a href="{{ route('profile-client',Auth::user()->id) }}" class="{{ Route::is('profile-client') ? 'active' : '' }}"><i class="fa fa-user"></i>Tài khoản {{ Auth::user()->name }}</a></li>
							@else
								<li><a href="{{ route('login-client') }}"><i class="fa fa-user"></i>Tài khoản của tôi</a></li>
							@endif
							
							@if(Auth::user())
								<li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
							@else
								<li><a href="{{ route('login-client') }}"><i class="fa fa-lock"></i>Đăng nhập</a></li>
							@endif
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/header-middle-->

	<div class="header-bottom">
		<!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Trang trủ</a></li>
							@if (Auth::user())
								<li class="dropdown"><a href="{{ route('post-client.index') }}" class="{{ Route::is('post-client.index') || Route::is('post.create') || Route::is('post.show') ? 'active' : '' }}">Facebook Fake</a>
								</li>
							@endif
						</ul>
					</div>
				</div>
				@if (Auth::user() && Route::is('post-client.index') || Auth::user() && Route::is('post.show'))
					<div class="col-sm-3 text-center">
						<a href="{{ route('post.create') }}" class="create"><i class="fa fa-plus-square-o icon_create" aria-hidden="true"></i>Tạo bài viết</a>
					</div>
				@endif
				
			</div>
		</div>
	</div>
	<!--/header-bottom-->
</header>
<style>
	.create{
		color: #696763;
		font-family: 'Roboto', sans-serif;
		font-size: 17px;
		font-weight: 300;
		padding: 0;
		padding-bottom: 10px;
	}

	.icon_create{
		margin-right:5px
	}

	#cart_count{
		border: none;
    		width: 15px;
		outline:none;
    		text-align: center;
	}
</style>