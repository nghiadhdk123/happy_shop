@extends('client.layout.master')

@section('main-content')
<div id="contact-page" class="container">
	<div class="bg">
		<div class="row">
			<form action="{{ route('post-client.store') }}" id="main-contact-form" class="contact-form row" name="contact-form" method="post" enctype="multipart/form-data">
			@csrf
				<div class="col-sm-8">
					<div class="contact-form">
						<h2 class="title text-center">Tạo bài viết</h2>
						<div class="status alert alert-success" style="display: none"></div>

						<div class="form-group col-md-12">
							<input type="text" name="title" class="form-control"
								required="required" placeholder="Tiêu đề bài viết">
						</div>
						<div class="form-group col-md-12">
							<textarea name="content" id="editor1" required="required"
								class="form-control" rows="2"
								placeholder="Nội dung bài viết"></textarea>
						</div>
						<div class="form-group col-md-12">
							<div class="tags">
								@foreach ($tags as $tag)
									<span class="btn tag_1">
										<input type="checkbox" name="tag[]" class="tag_put" value="{{ $tag->id }}">{{ $tag->name }}
									</span>
								@endforeach
							</div>
							
							
						</div>
						<div class="form-group col-md-12">
							<input type="submit" name="submit"
								class="btn btn-primary pull-right" value="Đăng bài">
						</div>

					</div>
				</div>
				<div class="col-sm-4 text-center">
					<div class="contact-info">
						<h2 class="title text-center">Tải ảnh lên</h2>
						<div id="rim_img">
							<img src="/frontend/images/default_image.jpg" alt=""
								id="change_img" class="img_post">
						</div>
						<span class="btn btn-danger btn-file">
							<span class="fileinput-new"><i class="fa fa-download"
									aria-hidden="true"></i> Tải ảnh lên </span>
							<input id="uploadFile" type="file" name="image">
						</span>

					</div>

				</div>
			</form>
		</div>
	</div>
</div>
<!--/#contact-page-->
<style>
#rim_img {
	height: 150px;
	border: 2px dashed black;
	border-radius: 5px;
	display: flex;
	justify-content: center;
	align-items: center;
}

.img_post {
	width: 85%;
	height: 85%;
	object-fit: cover;
}

.btn-file {
	margin-top: 5%;
}

.btn-file>input {
	position: absolute;
	top: 0;
	right: 0;
	width: 100%;
	height: 100%;
	margin: 0;
	font-size: 23px;
	cursor: pointer;
	filter: alpha(opacity=0);
	opacity: 0;
	direction: ltr;
}

input[type=file] {
	display: block;
}

.tags{
	border: 1px solid #ddd;
    	padding: 7px 4% 40px 4%;
	border-radius: 4px;
	width: 100%;
}

.tag_1{
	background-color:#d7d7d7;
	position: relative;
	border-radius:0 !important;
	font-weight:bold;
	margin-bottom:1%;
}

.tag_put{
	width: 100%;
	height: 100%;
	position: absolute;
	left:0;
	top:0;
	margin:0 !important;
	outline:none !important;
	border:none !important;
	opacity: 0;
	cursor: pointer;
}
</style>
@endsection

@section('script-end')
<script>
function previewImages() {
	var change_img = document.querySelector('#change_img');
	if (this.files) {
		[].forEach.call(this.files, readAndPreview);
	}

	function readAndPreview(file) {
		if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
			return alert(file.name + " is not an image");
		}
		var reader = new FileReader();
		reader.addEventListener("load", function() {
			change_img.src = this.result;
		});
		reader.readAsDataURL(file);
	}
}


document.querySelector('#uploadFile').addEventListener("change", previewImages);
</script>
<script>
	var tag = document.getElementsByClassName('tag_put');
	var tag1 = document.getElementsByClassName('tag_1');

	console.log(tag.length);

	for(let i = 0 ; i < tag.length ; i++)
	{
		tag[i].addEventListener('click',() => {
			if(tag[i].checked == true)
			{
				tag1[i].style.backgroundColor = '#FE980F';
				tag1[i].style.color = 'white';
			}else{
				tag1[i].style.backgroundColor = '#d7d7d7';
				tag1[i].style.color = 'black';
			}
		});
		
	}
</script>
@endsection