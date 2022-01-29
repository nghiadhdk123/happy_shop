<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Home | E-Shopper</title>
	<link href="/frontend/css/bootstrap.min.css" rel="stylesheet">
	<link href="/frontend/css/font-awesome.min.css" rel="stylesheet">
	<link href="/frontend/css/prettyPhoto.css" rel="stylesheet">
	<link href="/frontend/css/price-range.css" rel="stylesheet">
	<link href="/frontend/css/animate.css" rel="stylesheet">
	<link href="/frontend/css/main.css" rel="stylesheet">
	<link href="/frontend/css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
		integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="/frontend/images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/frontend/images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/frontend/images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/frontend/images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/frontend/images/ico/apple-touch-icon-57-precomposed.png">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
</head>
<!--/head-->
<style>
	#loading{
		width: 100%;
    		height: 100%;
    		position: fixed;
    		background: #ffffffb0;
    		z-index: 999999;
    		top: 0;
    		left: 0;
		display: flex;
		justify-content: center;
		align-items : center;
	}

	#loading img{
		width: 300px;
		height: 300px;
		border-radius:50%;
		object-fit:cover;
	}
</style>
<body>
	<div id="loading">
		<img src="/frontend/images/loading_page_2.gif" alt="loading">
	</div>
	@include('sweetalert::alert')
	@include('client.include.header') 
	<!--/header-->

	@yield('slider')
	<!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				@yield('main-content')
			</div>
		</div>
	</section>

	@include('client.include.footer')
	<!--/Footer-->



	<script src="/frontend/js/jquery.js"></script>
	<script src="/frontend/js/bootstrap.min.js"></script>
	<script src="/frontend/js/jquery.scrollUp.min.js"></script>
	<script src="/frontend/js/price-range.js"></script>
	<script src="/frontend/js/jquery.prettyPhoto.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
		integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="/frontend/js/main.js"></script>
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script> CKEDITOR.replace('editor1'); </script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
	@yield('script-end')
	@if (Session::has('success'))
		<script>
			toastr.success("{!! Session::get('success') !!}");
		</script>
	@endif
	@if (Session::has('error'))
		<script>
			toastr.error("{!! Session::get('error') !!}");
		</script>
	@endif
	<script>
		$(document).ready(function(){
			console.log("h2N1")

			window.addEventListener('load', function() {
  				$('#loading').delay(800).fadeOut('fast');
			});

			var show_cateory = document.getElementsByClassName('show-cateory');

			// console.log(parent_categories.length);
			for(let i = 0 ; i < show_cateory.length ; i++)
			{
				show_cateory[i].addEventListener('click',() => {
					$('.parent-categories').eq(i).slideToggle(300);
				});
			}

			$('.shipping').slick({
				dots: false,
				infinite: true,
				autoplay: true,
				speed: 500,
				fade: true,
				cssEase: 'ease-in-out',
				arrows: false,
				});
		});
	</script>
</body>

</html>