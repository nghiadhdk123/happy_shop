@extends('client.layout.master')

@section('main-content')
@include('client.include.sidebar')
<div class="col-sm-9 padding-right">
	<div class="product-details">
		<!--product-details-->
		<div class="col-sm-5 col-12">
			<div class="view-product">
				<img src="{{ $product->images[0]->image_url }}" class="newarrival" alt="" />
			</div>
		</div>
		<div class="col-sm-7 col-12">
			<div class="product-information">
				<!--/product-information-->
				<h2>{{ $product->name }}</h2>
				<p>Mã sản phẩm : {{ $product->slug }}</p>
				<img src="/frontend/images/product-details/rating.png" alt="" />
				<span>
					<span>${{ $product->sale_price }}</span>
					<label>Số lượng : </label>{{ $product->inventory }}
					@if ($product->status == App\Models\Product::Het_Hang)
					<a class="btn btn-fefault cart click_me" data-name="{{ $product->name }}"
						style="cursor:not-allowed">
						<i class="fa fa-shopping-cart"></i>
						Hết hàng
					</a>
					@else
					<a class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Thêm vào giỏ hàng
					</a>
					@endif

				</span>
				@foreach ($product->content_more_json as $key => $value )
				<p><b>{{ $key }} : </b> {{ $value }}</p>
				@endforeach
				<a href=""><img src="/frontend/images/product-details/share.png"
						class="share img-responsive" alt="" /></a>
			</div>
			<!--/product-information-->
		</div>
	</div>
	<!--/product-details-->

	<div class="category-tab shop-details-tab">
		<!--category-tab-->
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá ({{ count($product->comment) }})</a></li>
				<li><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane fade fade" id="details">
				<div class="col-sm-12">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center" style="padding: 25px;">
								{!! $product->description !!}
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="tab-pane active in" id="reviews">
				<div class="col-sm-12 chu">
					<div class="boxchat">
						@if (Auth::user())
						<div class="image_user">
							@if (Auth::user()->avatar)
							<img src="{{ Illuminate\Support\Facades\Storage::url(auth::user()->avatar) }}"
								alt="">
							@else
							@if (Auth::user()->avatar_url)
							<img src="{{ auth::user()->avatar_url }}" alt="">
							@else
							<img src="/frontend/images/shop/product8.jpg" alt="">
							@endif
							@endif
						</div>
						<form action="javascript:CommentDe({{$product->id}})" method="POST">
							@csrf
							<input type="text" name=""
								placeholder="Viết bình luận của bạn..."
								class="form-control content_comment" />
							<input type="hidden" value="{{ $product->id }}"
								class="product_comment_id">
						</form>
						@endif
					</div>
					@foreach($comment_post as $value)

					<div class="comment_users col-sm-12">
						<div class="image_user">
							@if ($value->user->avatar)
							<img src="{{ Illuminate\Support\Facades\Storage::url($value->user->avatar) }}"
								alt="">
							@else
							@if ($value->user->avatar_url)
							<img src="{{ $value->user->avatar_url }}" alt="">
							@else
							<img src="/frontend/images/shop/product8.jpg" alt="">
							@endif
							@endif
						</div>

						<div class="content_user">

							<p class="content">
								<span class="name_user_content">{{ $value->user->name }}</span>

								{{ $value->content }}
							</p>
							<a class="time_content"><i class="fa fa-clock-o time_comment"></i>{{ $value->created_at->format('h:i') }} - {{ $value->created_at->format('d/m/Y') }} </a></li>
						</div>
					</div>
					@if (count($value->parent) > 0)
					@foreach ($value->parent as $key)
						
					
					<div class="comment_users_parent col-sm-12">
						<div class="image_user">
							@if ($key->user->avatar)
							<img src="{{ Illuminate\Support\Facades\Storage::url($key->user->avatar) }}"
								alt="">
							@else
							@if ($key->user->avatar_url)
							<img src="{{ $key->user->avatar_url }}" alt="">
							@else
							<img src="/frontend/images/shop/product8.jpg" alt="">
							@endif
							@endif
						</div>

						<div class="content_user">

							<p class="content">
								<span class="name_user_content">{{ $key->user->name }}</span>
								{{ $key->content }}							
							</p>
							<a class="time_content"><i class="fa fa-clock-o time_comment"></i>{{ $key->created_at->format('h:i') }} - {{ $key->created_at->format('d/m/Y') }}</a></li>
						</div>
					</div>
					@endforeach
					@endif


					<div class="boxchat_user_parent col-sm-12">
						@if (Auth::user())
						<div class="image_user">
							@if (Auth::user()->avatar)
							<img src="{{ Illuminate\Support\Facades\Storage::url(auth::user()->avatar) }}"
								alt="">
							@else
							@if (Auth::user()->avatar_url)
							<img src="{{ auth::user()->avatar_url }}" alt="">
							@else
							<img src="/frontend/images/shop/product8.jpg" alt="">
							@endif
							@endif
						</div>

						<div class="content_boxchat_user_parent">
							<form action="javascript:ReplyComment({{ $value->id }})">
								@csrf
								<input type="text"
									placeholder="Viết phản hồi của bạn ..."
									class="form-control content_reply{{$value->id}}">
								<input type="hidden" value="{{ $product->id }}" class="product_id{{$value->id}}">
							</form>
						</div>
						@endif
					</div>
					@endforeach
				</div>

			</div>

		</div>
	</div>
	<!--/category-tab-->

	<div class="recommended_items">
		<!--recommended_items-->
		<h2 class="title text-center">recommended items</h2>

		<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active">
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="images/home/recommend1.jpg" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button"
										class="btn btn-default add-to-cart"><i
											class="fa fa-shopping-cart"></i>Add
										to cart</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="images/home/recommend2.jpg" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button"
										class="btn btn-default add-to-cart"><i
											class="fa fa-shopping-cart"></i>Add
										to cart</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="images/home/recommend3.jpg" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button"
										class="btn btn-default add-to-cart"><i
											class="fa fa-shopping-cart"></i>Add
										to cart</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="images/home/recommend1.jpg" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button"
										class="btn btn-default add-to-cart"><i
											class="fa fa-shopping-cart"></i>Add
										to cart</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="images/home/recommend2.jpg" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button"
										class="btn btn-default add-to-cart"><i
											class="fa fa-shopping-cart"></i>Add
										to cart</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="images/home/recommend3.jpg" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button"
										class="btn btn-default add-to-cart"><i
											class="fa fa-shopping-cart"></i>Add
										to cart</button>
								</div>
							</div>
						</div>
					</div>
				</div>
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
.chu {
	/* overflow: hidden; */
}

.boxchat {
	display: flex;
	justify-content: center;
	align-items: center;
}

#reviews .boxchat form {
	width: 100%;
}

#reviews .boxchat form .content_comment {
	width: 100%;
	height: 50px !important;
	border-radius: 35px;
	margin-left: 1%;
}

.image_user img {
	width: 40px;
	height: 40px;
	object-fit: cover;
	border-radius: 50%;
}

.comment_users {
	display: flex;
	margin-top: 5%;
}

.content_user{
	width: 70%;
}

.content {
	width: 100%;
	margin: 0;
	background: #f0f2f5;
	border: 1px solid #f0f2f5;
	border-radius: 10px;
	padding: 10px;
	margin-left: 2%;
}

.name_user_content {
	display: block;
	font-weight: bold;
}

.time_content {
	display: block;
	margin-left: 3%;
	margin-top: 1%;
	font-size: 12px;
}

.time_comment{
	margin-right: 1%;
}

.comment_users_parent {
	display: flex;
	margin-top: 2%;
	margin-left: 10%;
}

.boxchat_user_parent {
	display: flex;
	justify-content: start;
	align-items: center;
	margin-top: 2%;
	margin-left: 10%;
}

.content_boxchat_user_parent {
	width: 80%;
}

.content_boxchat_user_parent form input {
	height: 50px !important;
	border-radius: 35px;
	margin-left: 1%;
}
</style>
@endsection

@section('script-end')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
	integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {

	$('.click_me').click(function(event) {
		var name = $(this).data('name');
		// console.log(name);
		event.preventDefault();
		swal("! Xin lỗi bạn " + name + " đã hết hàng !");

	});
});

function CommentDe(id) {
	var content = $('.content_comment').val();
	var product_id = $('.product_comment_id').val();
	var _token = $('input[name="_token"]').val();
	// alert(content + product_id + _token);
	$.ajax({
		type: "POST",
		url: "{{ route('comment.store') }}",
		data: {
			content: content,
			product_id: product_id,
			_token: _token,
		},

		success: function() {
			location.reload();
		},
		error: function() {
			console.log("TB")
		}
	});
}

function ReplyComment(id)
{
	var parent = id;
	var _token = $('input[name="_token"]').val();
	var content = $('.content_reply'+id).val();
	var product_id = $('.product_id'+id).val();

	// console.log(id + _token + content + product_id);
	$.ajax({
		type: "POST",
		url: "{{ route('comment.reply') }}",
		data: {
			parent:id,
			content:content,
			product_id:product_id,
			_token:_token,
		},
		success: function () {
			location.reload();
		},
		error: function(){
			console.log("TB");
		}
	});
}
</script>
@endsection