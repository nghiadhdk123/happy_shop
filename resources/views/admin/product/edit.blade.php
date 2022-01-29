@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">

		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="{{ route('user.index') }}">Sản phẩm</a></li>
				<li class="breadcrumb-item active">Tạo mới</li>
			</ol>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.container-fluid -->
<!-- Content -->
<div class="container-fluid">
	<!-- Main row -->
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Tạo mới sản phẩm</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" action="{{ route('product.update',$product->id) }}" method="POST"
					autocomplete="off" enctype="multipart/form-data">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Tên sản phẩm</label><span
								class="requie">*</span>
							<input type="text" class="form-control" id="" name="name"
								placeholder="Tên sản phẩm" value="{{ $product->name }}">
							@error('name')
							<div><span class="requie">{{ $message }}</span></div>
							@enderror
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Danh mục sản phẩm</label><span
								class="requie">*</span>
							<select class="form-control" id="my-select"
								data-live-search="true" name="category_id">
								<option value="0" selected>Không có danh mục</option>
								@foreach ($category as $value)
								<option value="{{ $value->id }}"
									{{ $product->category_id == $value->id ? 'selected' : '' }}>
									{{ $value->name }}</option>
								@foreach ($parent as $parents)
								@if($parents->parent_id == $value->id)
								<option value="{{ $parents->id }}"
									{{ $product->category_id == $parents->id ? 'selected' : '' }}>
									{{ $parents->id }}-----{{ $parents->name }}
								</option>
								@endif
								@endforeach
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Số lượng sản phẩm</label><span class="requie">*</span>
							<input type="text" class="form-control" name="quantity"
								placeholder="Nhập số lượng sản phẩm"
								value="{{ $product->quantity }}">
							@error('quantity')
							<div><span class="requie">{{ $message }}</span></div>
							@enderror

						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label class="control-label">Giá gốc</label><span
									class="requie">*</span>
								<input type="text" class="form-control"
									name="origin_price"
									placeholder="Nhập giá gốc sản phẩm"
									value="{{ $product->origin_price }}">
								@error('origin_price')
								<div><span class="requie">{{ $message }}</span></div>
								@enderror
							</div>

							<div class="col-md-6 form-group">
								<label class="control-label">Giá giảm</label><span
									class="requie">*</span>
								<input type="text" class="form-control"
									name="sale_price"
									placeholder="Nhập giá giảm sản phẩm"
									value="{{ $product->sale_price }}">
								@error('sale_price')
								<div><span class="requie">{{ $message }}</span></div>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1" class="d-block">Xóa hình
								ảnh</label>
							<div id="boxImg">
								@foreach($product->images as $image)
								<div id="buu">
									<img src="{{ $image->image_url}}"
										class="rounded float-start d-block"
										alt="...">
									<div class="d-flex justify-content-center"
										style="margin-top: 10px;">
										<input class="" type="checkbox"
											name="delete_img[]"
											value="{{ $image->id }}">
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Hình ảnh sản phẩm</label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input"
										name="image[]" id="uploadFile" multiple>
									<label class="custom-file-label"
										for="exampleInputFile">Chọn ảnh</label>
								</div>
							</div>
							<div class="gallere" style="display: flex; flex-wrap: wrap;">
							</div>
						</div>

						<div class="form-group">
							<label>Mô tả sản phẩm</label>
							<textarea name="description" class="form-control "
								id="editor1">{{ $product->description }}</textarea>
						</div>
							<div id="clone">
								<label for="">Thông số kỹ thuật</label>
								<span id="tes" class="btn btn-sm btn-warning">Thêm</span>
								@if ($product->content_more != null)
								@php
								$i = 0;
								@endphp
								@foreach ($product->content_more_json as $key => $value)
								@php
								$i++;
								@endphp
								<div class="row" id="row{{ $i }}">
									<div class="col-4 col-lg-2">
										<div class="form-group">
											<input type="text"
												class="form-control"
												id="" name="key[]"
												value="{{ $key }}">
										</div>
									</div>
									<div class="col-8 col-lg-10">
										<div class="form-group"
											style="position: relative;">
											<input type="text"
												class="form-control"
												id="" name="val[]"
												value="{{ $value }}">
											<span class="btn btn-sm btn-danger closee d-flex align-items-center justify-content-center"
												id="{{ $i }}"
												style="position: absolute; right: 0; top: 0; height: 100%; cursor: pointer;">Close</span>
										</div>
									</div>
								</div>
								@endforeach
								@endif

							</div>

						<div class="col-md-12 form-group1 group-mail">
							<label class="control-label">Trạng thái sản phẩm</label><span
								class="requie">*</span>
							<select class="form-control" id="my-select-2"
								data-live-search="true" name="status">
								@foreach(App\Models\Product::$status_text as $key =>
								$value)
								<option value="{{ $key }}"
									{{ $product->status == $key ? 'selected' : '' }}>
									{{ $value }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<!-- /.card-body -->

					<div class="card-footer">
						<a href="{{ route('product.list',Auth::user()->id) }}" class="btn btn-dark">Huỷ bỏ</a>
						<button type="submit" class="btn btn-success">Cập nhật</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.row (main row) -->
</div><!-- /.container-fluid -->

<style>
.requie {
	color: red;
}

.gallere {
	display: flex;
	align-items: center;
	flex-direction: row;

}

.gallere>img {
	margin-right: 20px;
	object-fit: cover;
}

#buu {
	display: flex;
	flex-wrap: wrap;
	flex-direction: column;
}

#buu>img {
	width: 150px;
	height: 150px;
	margin-right: 20px;
	object-fit: cover
}

#boxImg {
	display: flex;
	flex-wrap: wrap;
	flex-direction: row;
}
</style>
@endsection

@section('script-end')
<script>
$(document).ready(function() {
	$('#my-select').selectpicker();

	$('#my-select-2').selectpicker();

	@if(!empty($product->content_more_json))
	var i = {{count($product->content_more_json)}};
	@else
	var i = 0;
	@endif

	$("#tes").click(function() {
		i++;
		$('#clone').append('<div class="row" id="row' + i + '">' +
			'<div class="col-4 col-lg-2"><div class="form-group">' +
			'<input type="text" class="form-control" id="" name="key[]" value="">' +
			'</div></div><div class="col-8 col-lg-10">' +
			'<div class="form-group" style="position: relative;">' +
			'<input type="text" class="form-control" id="" name="val[]" value="">' +
			'<span class="btn btn-sm btn-danger closee d-flex align-items-center justify-content-center" id="' +
			i +
			'" style="position: absolute; right: 0; top: 0; height: 100%; cursor: pointer;">Close</span>' +
			'</div></div></div>')
	});
	$(document).on('click', '.closee', function() {
		var button_id = $(this).attr("id");
		$('#row' + button_id + '').remove();
	});
});
</script>

<script>
function previewImages() {
	var preview = document.querySelector('.gallere');
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
			var image = new Image();
			image.width = 150;
			image.height = 150;
			image.title = file.name;
			image.src = this.result;
			preview.appendChild(image);
		});
		reader.readAsDataURL(file);
	}
}


document.querySelector('#uploadFile').addEventListener("change", previewImages);
</script>
@endsection