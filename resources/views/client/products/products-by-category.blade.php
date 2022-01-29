@extends('client.layout.master')

@section('slider')
<section id="advertisement">
	<div class="container">
		<img src="/frontend/images/shop/advertisement.jpg" alt="" />
	</div>
</section>
@endsection

@section('main-content')
@include('client.include.sidebar')
<div class="col-sm-9 padding-right">
	<div class="features_items">
		<!--features_items-->
		<h2 class="title text-center">{{ $product_by_category->name }}</h2>
		@foreach ($product_by_category->products as $product)
		<div class="col-sm-4">
			<div class="product-image-wrapper">
				<div class="single-products">
					<div class="productinfo text-center case">
						@if (count($product->images) > 0)
							<img src="{{ $product->images[0]->image_url }}" alt="" class="img_lq" />
						@endif
						<style>
							.case .img_lq{
								width: 150px !important;
								height: 150px;
							}
						</style>
						<h2>${{ $product->sale_price }}</h2>
						<p>{{ $product->name }}</p>
					</div>
					
				</div>
				<div class="choose">
					<ul class="nav nav-pills nav-justified">
						@if($product->status == App\Models\Product::Het_Hang)
							<li><a href="#" class="click_me" data-name="{{ $product->name }}" style="cursor:not-allowed"><i class="fa fa-shopping-cart"></i>Hết hàng</a></li>
						@else
							<li><a href="#"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a></li>
						@endif
						<li><a href="{{ route('product.detail',$product->slug) }}"><i class="fa fa-eye"></i>Xem chi tiết</a></li>
					</ul>
				</div>
			</div>
		</div>
		@endforeach
		
	</div>
	<!--features_items-->
</div>
@endsection