<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Trang bị</h2>
		<div class="panel-group category-products" id="accordian">
			<!--category-productsr-->
			@foreach ($categories as $key => $category)
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="{{ route('product-by-category',$category->slug) }}" class="category">
							{{ $category->name }}
						</a>
						<span class="badge pull-right show-cateory" style="cursor:{{ count($category->children) > 0 ? 'pointer' : 'not-allowed' }}"><i class="fa fa-plus"></i></span>
					</h4>
				</div>
				<div id="category{{$key}}" class="panel-collapse parent-categories">
				@if(count($category->children) > 0)
						<div class="panel-body">
							<ul>
								@foreach ($category->children as $parent)
									<li><a href="{{ $parent->id }}">{{ $parent->name }}</a></li>
								@endforeach
							</ul>
						</div>
				@endif
				</div>
			</div>
			@endforeach
		</div>
		<!--/category-products-->
		@if (Auth::user())
		<div class="brands_products">
			<!--brands_products-->
			<h2>Bài viết</h2>
			<div class="brands-name">
				<ul class="nav nav-pills nav-stacked">
					@foreach ($tags as $tag)
						<li><a href="{{ route('post.post-by-tag',$tag->id) }}"> <span class="pull-right">({{ count($tag->posts) }})</span>{{ $tag->name }}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
		<!--/brands_products-->
		@endif
		<div class="shipping text-center">
			<!--shipping-->
			<div class="item">
				<img src="/frontend/images/merry.jpg" alt="" />
			</div>
			<div class="item">
				<img src="/frontend/images/merry_2.jpg" alt="" />
			</div>
			<div class="item">
				<img src="/frontend/images/merry_3.jpg" alt="" />
			</div>
			
			
		</div>
		<button class="btn btn-primary nit">Nhanh vào đặt hàng nào</button>
		<!--/shipping-->

	</div>
</div>

<style>
	.parent-categories{
		display: none;
	}

	.shipping{
		background:transparent;
	}

	.item{
		width: 100%;
	}

	.shipping .item img{
		width: 100%;
		height: 400px;
	}

	.nit{
		width: 100%;
   		border-radius: 5px;
	}

	.slick-initialized .slick-slide{
		padding:0 !important;
	}
</style>