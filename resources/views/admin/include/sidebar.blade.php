<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="/backend/dist/img/logo_shop-removebg-preview.png" alt="Logo" style="width:100%;height:auto">
		<!-- <span class="brand-text font-weight-light">My shop</span> -->
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				@if(Auth::user()->avatar_url)
				<img src="{{ Auth::user()->avatar_url }}" style="object-fit: cover;"
					 alt="User Image">
				@else
				@if(Auth::user()->avatar)
				<img src="{{ \Illuminate\Support\Facades\Storage::url(Auth::user()->avatar) }}"
					style="object-fit: cover;"  alt="User Image">
				@else
				<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/OOjs_UI_icon_userAvatar-constructive.svg/1024px-OOjs_UI_icon_userAvatar-constructive.svg.png"
					 alt="User Image">
				@endif
				@endif
			</div>
			<div class="info">
				<a href="{{ route('user.show',Auth::user()->id) }}" class="d-block">{{ Auth::user()->name }}</a>
			</div>
		</div>
		<style>
			.user-panel img{
				height: 2.1rem;
			}
		</style>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
				data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
				<li class="nav-item has-treeview {{ Route::is('dash.admin') ? 'menu-open' : '' }}">
					<a href="{{ route('dash.admin') }}" class="nav-link {{ Route::is('dash.admin') ? 'active' : '' }}">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Bảng điều khiển
						</p>
					</a>

				</li>

				<!-- Quản lí sản phẩm -->
				@if(auth()->user()->hasAnyPermission(['create product','edit product','destroy product']))
				<li class="nav-item has-treeview {{ Route::is('product.create') || Route::is('product.list') || Route::is('product.index') ? 'menu-open' : '' }}">
					<a href="#" class="nav-link {{ Route::is('product.create') || Route::is('product.list') || Route::is('product.index') ? 'active' : '' }}">
						<i class="nav-icon fas fa-shopping-basket"></i>
						<p>
							Quản lý sản phẩm
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						@if(auth()->user()->hasAnyPermission(['create product']))
						<li class="nav-item">
							<a href="{{ route('product.create') }}" class="nav-link {{ Route::is('product.create') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Tạo mới</p>
							</a>
						</li>
						@endif
						<li class="nav-item">
							<a href="{{ route('product.list',Auth::user()->id) }}" class="nav-link {{ Route::is('product.list') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Danh sách</p>
							</a>
						</li>
						@if (Auth::user()->role == App\Models\User::ADMIN)
							<li class="nav-item">
							<a href="{{ route('product.index') }}" class="nav-link {{ Route::is('product.index') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Danh sách tất cả sản phẩm</p>
							</a>
						</li>
						@endif
					</ul>
				</li>

				<!-- Quản lí Voucher -->
				<li class="nav-item has-treeview {{ Route::is('voucher.create') || Route::is('voucher.index') ? 'menu-open' : '' }}">
					<a href="#" class="nav-link {{ Route::is('voucher.create') || Route::is('voucher.index') ? 'active' : '' }}">
						<i class="nav-icon fas fa-gift"></i>
						<p>
							Quản lý voucher
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						
						<li class="nav-item">
							<a href="{{ route('voucher.create') }}" class="nav-link {{ Route::is('voucher.create') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Tạo mới</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('voucher.index') }}" class="nav-link {{ Route::is('voucher.index') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Danh sách</p>
							</a>
						</li>
					</ul>
				</li>
				@endif

				<!-- Quản lí danh mục sản phẩm -->
				@if(auth()->user()->hasAnyPermission(['create category','edit category','destroy category']))
				<li class="nav-item has-treeview {{ Route::is('category.create') || Route::is('category.index') ? 'menu-open' : '' }}">
					<a href="#" class="nav-link {{ Route::is('category.create') || Route::is('category.index') ? 'active' : '' }}">
						<i class="nav-icon fas fa-chart-pie"></i>
						<p>
							Quản lý danh mục
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						@if(auth()->user()->hasAnyPermission(['create category']))
						<li class="nav-item">
							<a href="{{ route('category.create') }}" class="nav-link {{ Route::is('category.create') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Tạo mới</p>
							</a>
						</li>
						@endif
						<li class="nav-item">
							<a href="{{ route('category.index') }}" class="nav-link {{ Route::is('category.index') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Danh sách</p>
							</a>
						</li>
					</ul>
				</li>
				@endif

				<!-- Quản lí người dùng -->
				@if(auth()->user()->hasAnyPermission(['create user','edit user','destroy user']))
				<li class="nav-item has-treeview {{ Route::is('user.create') || Route::is('user.index') || Route::is('user.list-delete') ? 'menu-open' : '' }}">
					<a href="#" class="nav-link {{ Route::is('user.create') || Route::is('user.index') || Route::is('user.list-delete') ? 'active' : '' }}">
						<i class="nav-icon fas fa-user"></i>
						<p>
							Quản lý người dùng
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						@if(auth()->user()->hasAnyPermission(['create user']))
						<li class="nav-item">
							<a href="{{ route('user.create') }}" class="nav-link {{ Route::is('user.create') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Tạo mới</p>
							</a>
						</li>
						@endif
						<li class="nav-item">
							<a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.index') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Danh sách</p>
							</a>
						</li>
						@if(auth()->user()->hasAnyPermission(['respone user']))
						<li class="nav-item">
							<a href="{{ route('user.list-delete') }}" class="nav-link {{ Route::is('user.list-delete') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Danh sách xóa</p>
							</a>
						</li>
						@endif
					</ul>
				</li>
				@endif

				<!-- Quản lí bài viết và quản lí thẻ -->
				@if(auth()->user()->hasAnyPermission(['create post','edit post','destroy post']))
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-book"></i>
						<p>
							Quản lý bài viết
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('category.index') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Danh sách</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item has-treeview {{ Route::is('tag.index') || Route::is('tag.create') ? 'menu-open' : '' }}">
					<a href="#" class="nav-link {{ Route::is('tag.index') || Route::is('tag.create') ? 'active' : '' }}">
						<i class="nav-icon fas fa-tag"></i>
						<p>
							Quản lý thẻ
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('tag.create') }}" class="nav-link {{ Route::is('tag.create') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Tạo mới</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('tag.index') }}" class="nav-link {{ Route::is('tag.index') ? 'active' : '' }}">
								<i class="far fa-circle nav-icon"></i>
								<p>Danh sách</p>
							</a>
						</li>
					</ul>
				</li>
				@endif

				<!-- Quản lí đơn hàng -->
				<li class="nav-item has-treeview {{ Route::is('order.index') ? 'menu-open' : '' }}">
					<a href="{{ route('order.index') }}" class="nav-link {{ Route::is('order.index') ? 'active' : '' }}">
						<i class="nav-icon fas fa-shopping-cart"></i>
						<p>
							Quản lý đơn hàng
						</p>
					</a>

				</li>

				<!-- Thống kê doanh thu -->
				@if(auth()->user()->hasAnyPermission(['seen statistical']))
				<li class="nav-item has-treeview {{ Route::is('statis.index') ? 'menu-open' : '' }}">
					<a href="{{ route('statis.index') }}" class="nav-link {{ Route::is('statis.index') ? 'active' : '' }}">
						<i class="nav-icon fas fa-chart-bar"></i>
						<p>
							Thống kê
						</p>
					</a>

				</li>
				@endif

				<!-- Đăng xuất tài khoản -->
				<li class="nav-item has-treeview">
					<a href="{{ route('logout') }}" class="nav-link">
						<i class="nav-icon fas fa-sign-out-alt"></i>
						<p>
							Đăng xuất
						</p>
					</a>

				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>