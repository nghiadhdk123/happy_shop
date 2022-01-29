@extends('client.layout.master')

@section('main-content')
<div class="col-sm-12">
	<div class="blog-post-area">
		<h2 class="title text-center">Chi tiết bài viết</h2>
		<div class="single-blog-post">
			<h3>{{ $post->title }}</h3>
			<div class="post-meta">
				<ul>
					<li><i class="fa fa-user"></i>{{ $post->name_user }}</li>
					<li><i class="fa fa-clock-o"></i>{{ $post->created_at->format('h:i') }}</li>
					<li><i class="fa fa-calendar"></i>{{ $post->created_at->format('d/m/Y') }}</li>
				</ul>
				<span>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
				</span>
			</div>
			<a href="">
				<img src="{{ Illuminate\Support\Facades\Storage::url($post->image) }}" alt="">
			</a>
			<p>
				{!! $post->content !!}
			</p>
			<div class="pager-area">
				
			</div>
		</div>
	</div>
	<!--/blog-post-area-->

	<div class="rating-area">
		<ul class="ratings">
			<li class="rate-this">Số sao:</li>
			<li>
				<i class="fa fa-star color"></i>
				<i class="fa fa-star color"></i>
				<i class="fa fa-star color"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
			</li>
			<li class="color">(6 votes)</li>
		</ul>
		<ul class="tag">
			<li>TAG:</li>
			@foreach ($post->tags as $tag)
				<li><a class="color" href="{{ route('post.post-by-tag',$tag->id) }}">{{ $tag->name }} <span>/</span></a></li>
			@endforeach
		</ul>
	</div>
	<!--/rating-area-->

	<div class="socials-share">
		<a href=""><img src="/frontend/images/blog/socials.png" alt=""></a>
	</div>
	<!--/socials-share-->

	<div class="response-area">
		<h2>3 bài viết nữa</h2>
		<ul class="media-list">
			@foreach ($random_post as $value)
				<li class="media">
					<a class="pull-left" href="#">
						@if ($value->image)
							<img class="media-object" src="{{ Illuminate\Support\Facades\Storage::url($value->image) }}" alt="">
						@else
							<img class="media-object" src="/frontend/images/default_image.jpg" alt="">
						@endif
						
					</a>
					<div class="media-body">
						<ul class="sinlge-post-meta">
							<li><i class="fa fa-user"></i>{{ $value->name_user }}</li>
							<li><i class="fa fa-clock-o"></i>{{ $value->created_at->format('h:i') }}</li>
							<li><i class="fa fa-calendar"></i>{{ $value->created_at->format('d/m/Y') }}</li>
						</ul>
						<h3>
							<a href="{{ route('post.show',$value->slug) }}">{{ $value->title }}</a>
						</h3>
						@foreach ($value->tags as $tags)
							<a class="btn btn-primary tag" href="{{ route('post.post-by-tag',$tags->id) }}">{{ $tags->name }}</a>
						@endforeach
					</div>
				</li>
			@endforeach
			
		</ul>
	</div>
	<!--/Response-area-->
</div>
<style>
	.tag{
		margin-top:0 !important;
		margin-right:5px;
	}
</style>
@endsection