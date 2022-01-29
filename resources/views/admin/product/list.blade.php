@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
<!-- Content -->
<div class="container-fluid">
        <!-- Main row -->
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách sản phẩm</h3>

                        <div class="card-tools">
                            <div >
			    <form action="{{ route('user.index') }}" method="GET" class="input-group input-group-sm" style="width: 350px;">
				<input type="text" name="keyword" class="form-control float-right" placeholder="Tìm kiếm" value="{{ Request()->get('keyword') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
			    </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Số lượng</th>
                                <th>Tồn kho</th>
                                <th class="text-center">Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
				@foreach ($products as $key => $product)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $product->name }}</td>	
					<td>
						@if(count($product->images) > 0)
                                                	<img src="{{ $product->images[0]->image_url }}" alt="" width="90px" height="auto">
                                            	@endif
					</td>
					<td>
						@if ($product->category_id == 0)
							Không có danh mục
						@else
							{{ $product->category->name }}
						@endif

					</td>
					<td>{{ $product->quantity }}</td>
					<td>{{ $product->inventory }}</td>
					<td>
						@if($product->status == 0)
							<span class="badge badge-primary">{{ $product->status_text }}</span>
									@elseif($product->status == 1)
									<span class="badge badge-dark">{{ $product->status_text }}
									</span>
									@else
									<span
										class="badge badge-danger">{{ $product->status_text }}</span>
									@endif
					</td>
						
					<td>
						<a href="#" class="btn btn-dark btn-sm" id="detail" data-bs-toggle="tooltip" data-toggle="modal" data-target="#exampleModal" data-id={{ $product->id }} data-placement="top" title="Xem chi tiết"><i class="fa fa-eye"></i></a>
						
						<a href="{{ route('product.edit',$product->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
						<form id="for" action="{{ route('product.destroy',$product->id) }}" method="POST">
							@csrf
							<a href="#" class="btn btn-danger btn-sm delete-confirm" data-bs-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></a>
						</form>
						
					</td>
                            	</tr>
				    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    <style>
	    #for{
		    display: inline;
	    }
    </style>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chi tiết danh mục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="row">
						<div class="mb-10" style="width: 100%;">
							<div class="scroll-y me-n7 pe-7" id="modal_detail_payment"
								>
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Tên sản phẩm : </p>
											<span id="name_product"></span>
										</div>
									</div>
								</div>
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Danh mục sản phẩm : </p>
											<span id="category_product"></span>
										</div>
									</div>
								</div>
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Người tạo : </p> <span
												id="user_create_product"></span>
										</div>
									</div>
								</div>
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Giá gốc : </p> <span
												id="orgin_price_product"></span>
										</div>
									</div>
								</div>
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Trạng thái : </p> <span
												id="status_product"></span>
										</div>
									</div>
								</div>
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Giá bán : </p> <span
												id="sale_price_product"></span>
										</div>
									</div>
								</div>
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Số lượng : </p> <span
												id="quantity_product"></span>
										</div>
									</div>
								</div>
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Số lượng bán : </p> <span
												id="sell_number_product"></span>
										</div>
									</div>
								</div>
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Tồn kho : </p> <span
												id="inventory_product"></span>
										</div>
									</div>
								</div>
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Mô tả sản phẩm : </p> <span
												id="description_product"></span>
										</div>
									</div>
								</div>
								
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Ngày tạo : </p> <span
												id="created_at_product"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<style>
					.msi {
						width: 100%;
						/* border-bottom: 1px dashed; */
						padding: 3% 0;
						cursor: not-allowed;
					}

					.msi_2 {
						display: inline-block;
					}

					.btn_closes {
						margin-top: 5%;
						display: flex;
						justify-content: center;
						align-items: center;
					}
					</style>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
	@endsection

	@section('script-end')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
	$(document).ready(function() {

		$('#my-select').selectpicker();

		$('.delete-confirm').click(function(event) {
			var form = $(this).closest("form");
			var name = $(this).data("name");
			event.preventDefault();
			swal({
					title: `Bạn có muốn xóa không?`,
					text: "Nếu bạn xóa nó, bạn sẽ không thể khôi phục lại được.",
					icon: "warning",
					buttons: ["Không", "Xóa"],
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						form.submit();
					}
				});
		});

		$(function() {
			$('[data-bs-toggle="tooltip"]').tooltip()
		});

		$(document).on("click", "#detail", function() {
			var id = $(this).data('id');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: '{{ route('product.show') }}',
				method: 'POST',
				dataType: 'JSON',
				data: {
					id: id,
					_token: _token
				},
				success: function(data) {
					$('#name_product').html(data
						.NameProduct);
					$('#category_product').html(data
						.CategoryProduct);
					$('#user_create_product').html(data
						.UserCreateProduct);
					$('#status_product').html(data
						.StatusProduct);
					$('#quantity_product').html(data
						.QuantityProduct);
					$('#sell_number_product').html(data
						.SellProduct);
					$('#inventory_product').html(data
						.InventoryProduct);
					$('#description_product').html(data
						.DesProduct);
					$('#orgin_price_product').html(data
						.OriginProduct);
					$('#sale_price_product').html(data
						.SaleProduct);
					$('#created_at_product').html(data
						.CreatedProduct);
				}
			});
		});
	});
	</script>
@endsection