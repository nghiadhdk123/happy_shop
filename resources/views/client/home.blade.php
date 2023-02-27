@extends('client.layout.master')

@section('slider')
<section id="slider">
	<!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active">
						</li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>Vận chuyển miễn phí</h2>
								<p>E-SHOPPER vận chuyển miễn phí cho các bạn khi mua hàng.</p>
								<button type="button" class="btn btn-default get">Mua hàng ngay</button>
							</div>
							<div class="col-sm-6">
								<img src="/frontend/images/ani_3.png"
									class="girl img-responsive gau" alt="" />
							</div>
						</div>
						<div class="item">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>100% hàng chất lượng cao</h2>
								<p>E-SHOPPER luôn có những mặt hàng chất lượng cao để những vị tướng có trải nghiệm tốt nhất.</p>
								<button type="button" class="btn btn-default get">Mua hàng ngay</button>
							</div>
							<div class="col-sm-6">
								<img src="/frontend/images/ani_2.png"
									class="girl img-responsive gau" alt="" />
							</div>
						</div>

						<div class="item">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>Giao hàng siêu tốc</h2>
								<p>Với đội ngũ nhân viên giao hàng và xử lí đơn hàng nhanh sẽ giúp cho bạn trải nghiệm tốt nhất.</p>
								<button type="button" class="btn btn-default get">Mua hàng ngay</button>
							</div>
							<div class="col-sm-6">
								<img src="/frontend/images/ani_1.png"
									class="girl img-responsive gau" alt="" />
							</div>
						</div>

					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs"
						data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs"
						data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>

			</div>
		</div>
	</div>
</section>
@endsection

@section('main-content')
@include('client.include.sidebar')
<div class="col-sm-9 padding-right">
	<div class="features_items">
		<!--features_items-->
		<h2 class="title text-center">Trang bị</h2>
		@foreach ($products as $key => $product)
		<div class="col-sm-4">
			<div class="product-image-wrapper">
				<div class="single-products">
					<div class="productinfo text-center case">
						@if (count($product->images) > 0)
							<img src="{{ $product->images[0]->image_url }}" alt="" class="img_lq" />
						@endif
						<h2>{{ number_format($product->sale_price) }} VNĐ</h2>
						<p>{{ $product->name }}</p>
					</div>
					
				</div>
				<div class="choose">
					<ul class="nav nav-pills nav-justified">
						@if($product->status == App\Models\Product::Het_Hang)
							<li><a href="#" class="click_me" data-name="{{ $product->name }}" style="cursor:not-allowed"><i class="fa fa-shopping-cart"></i>Hết hàng</a></li>
						@else
							<li class="text-center">
								<form action="" method="POST">
									@csrf
									<input type="hidden" class="id_product_{{$product->id}}" value="{{ $product->id }}">
									<input type="hidden" class="name_product_{{$product->id}}" value="{{ $product->name }}">
									<input type="hidden" class="price_product_{{$product->id}}" value="{{ $product->sale_price }}">
									<input type="hidden" class="img_product_{{$product->id}}" value="{{ $product->images[0]->image_url }}">
									<li><a data-id="{{ $product->id }}" class="add-to-cart-ajax"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a></li>
								</form>
							</li>
						@endif
						<li><a href="{{ route('product.detail',$product->slug) }}"><i class="fa fa-eye"></i>Xem chi tiết</a></li>
					</ul>
				</div>
			</div>
		</div>
		@endforeach
		
	</div>
	<!--features_items-->

	

	<div class="recommended_items">
		<!--recommended_items-->
		<h2 class="title text-center">Trang bị ưa chuộng</h2>

		<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				@if($products_random->count() > 0)
				<div class="item active">
					{{-- @for ($i = 0 ; $i < 3 ; $i++)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center case2">
										<img src="{{ $products_random[$i]->images[0]->image_url }}"
											alt="" class="img_lq2" />
										<h2>{{ $products_random[$i]->sale_price }} VNĐ</h2>
										<p>
											{{ $products_random[$i]->name }}
										</p>
										<a href="#"
											class="btn btn-default add-to-cart"><i
												class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
									</div>

								</div>
							</div>
						</div>
					@endfor --}}
					</div>
					{{-- <div class="item">
						@for ($i = 3 ; $i < 6 ; $i++)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center case2">
										<img src="{{ $products_random[$i]->images[0]->image_url }}"
											alt="" class="img_lq2"/>
										<h2>{{ $products_random[$i]->sale_price }} VNĐ</h2>
										<p>
											{{ $products_random[$i]->name }}
										</p>
										<a href="#"
											class="btn btn-default add-to-cart"><i
												class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
									</div>

								</div>
							</div>
						</div>
						@endfor
						
						
						
					</div> --}}
				@endif
			</div>
			<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
	</div>
	<!--/recommended_items-->
</div>
<style>
	.case .img_lq{
		width: 150px !important;
		height: 150px;
	}

	.case2 .img_lq2{
		width: 115px !important;
   		height: 115px;
	}

	.gau{
		width: 484px !important;
		height: 441px;
	}
</style>
@endsection
@section('script-end')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
	$(document).ready(function() {

		$('.click_me').click(function(event) {
			var name = $(this).data('name');
			// console.log(name);
			event.preventDefault();
			swal("! Xin lỗi bạn " + name + " đã hết hàng !");
				
		});

		$('.add-to-cart-ajax').click(function(){
			var id = $(this).data('id');
			var _token = $('input[name="_token"]').val();
			var id_product = $('.id_product_'+id).val();
			var name_product = $('.name_product_'+id).val();
			var price_product = $('.price_product_'+id).val();
			var img_product = $('.img_product_'+id).val();
			

			$.ajax({
				type: "POST",
				url: "{{ route('add.cart') }}",
				data: {
					_token:_token,
					id_product:id_product,
					name_product:name_product,
					price_product:price_product,
					img_product:img_product,
				},
				success: function (data) {
					toastr.success('Thêm vào giỏ hàng thành công');
					// location.reload();
				},
				error: function (data) {
					toastr.error('Thêm vào giỏ hàng thất bại');
				}
			});
		});
	});
	</script>
@endsection