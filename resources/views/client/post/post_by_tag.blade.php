@extends('client.layout.master')

@section('main-content')
@include('client.include.sidebar')
<div class="col-sm-9">
	<div class="blog-post-area">
		<h2 class="title text-center">{{ $tag->name }}</h2>
		@foreach ($tag->posts as $post)
		<div class="single-blog-post">
			<div class="avatar">
				<div class="avatar-meta">
					<img src="{{ Illuminate\Support\Facades\Storage::url($post->avatar_user) }}" alt="" width="40px" height="40px">
				</div>
				<div class="post-meta">
					<h4 class="boss_post">{{ $post->name_user }}</h4>
					<ul>
						<li><i class="fa fa-clock-o"></i> {{ $post->created_at->format('h:i') }}</li>
						<li><i class="fa fa-calendar"></i> {{ $post->created_at->format('d-m-Y') }}</li>
					</ul>
				</div>
			</div>


			<a href="" class="img_post">
				<img src="{{ Illuminate\Support\Facades\Storage::url($post->image) }}" alt="">
			</a>
			<h3 class="title_post"><a href="{{ route('post.show',$post->slug) }}">{{ $post->title }}</a></h3>
			<a class="link_like">
				<i class="fa fa-thumbs-o-up" aria-hidden="true"></i><span class="number_like">{{ count($post->voteUsers) }}</span>
				<i class="fa fa-eye view-two" aria-hidden="true"></i><span class="number_like">{{ $post->view }}</span>
			</a>

			<div class="live_like">
				<form action="#">
				@csrf
					<a class="icons 
						@foreach ($post->voteUsers as $value)
							@if($value->id == Auth::user()->id)
								complete_like
							@endif
						@endforeach" 
					data-post="{{$post->id}}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Thích</a>
				</form>
			</div>
		</div>
		@endforeach


		<div class="pagination-area">

		</div>
	</div>
</div>

<style>
.avatar {
	display: flex;
	align-items: center;
}

.blog-post-area .post-meta {
	margin: 0 0 0 10px;
}

.img_post {
	display: block;
	margin-top: 25px;
}

.img_post {
	object-fit: cover;
}

.boss_post {
	margin: 0 0 5px 0;
}

.single-blog-post {
	background: #f0f2f5;
	padding: 25px;
	border-radius: 10px;
	margin-bottom: 5%;
	overflow: hidden;
}

.blog-post-area .post-meta ul li {
	background-color: antiquewhite;
}

.avatar-meta img {
	border-radius: 50%;
}

.img_post img {
	border-radius: 10px;
}

.number_like {
	display: inline-block;
	margin-left: 5px;
}

.link_like {
	display: flex;
	align-items:center;
	color: black;
	border-top: 1px solid #ced0d4;
    	margin-top: 5%;
	padding-top: 2%;
}

.complete_like{
	color:blue !important;
	font-weight:bold;
}

.title_post {
	margin-top: 0;
}

.title_post a {
	color: black;
}

.live_like{
	width: 100%;
    	border-top: 1px solid #ced0d4;
    	margin: 15px 0;
	padding-top: 2%;
	position: relative;
}

.live_like a{
	color:gray;
	cursor: pointer;
}

.liker{
	width: 50px !important;
	height: 50px !important;
	margin:0 !important;
}

.icons{
	width: 95px;
	height: 25px;
	display: flex;
	justify-content: center;
	align-items: center;
	transition:0.3s;
}

.icons i{
	margin-right: 5%;
}

.icons:hover{
	background: #80808057;
}

.view-two{
	margin-left:3%;
}

</style>
@endsection

@section('script-end')
	<script>
		
		$(document).ready(function () {
			var like = document.getElementsByClassName('icons');

		

			for (let index = 0; index < like.length; index++) {
				$('.icons').eq(index).click(function(){
					var post = $(this).data('post');
					var _token = $('input[name="_token"]').val();

					$.ajax({
						type: "POST",
						url: "{{ route('post.like') }}",
						data: {
							post:post,
							_token:_token,
						},
						success: function (data) {
							location.reload()
						}
					});
				});
			}


			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			});
		});

		
	</script>
@endsection