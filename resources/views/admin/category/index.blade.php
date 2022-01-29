@extends('admin.layout.master')

@section('main-content')
	<!-- Content Header -->
<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Danh mục</a></li>
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
                        <h3 class="card-title">Danh sách danh mục</h3>

                        <div class="card-tools">
                            <div >
			    <form action="{{ route('category.index') }}" method="GET" class="input-group input-group-sm" style="width: 350px;">
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
                                <th>Tên</th>
                                <th>Danh mục cha</th>
                                <th>Người tạo</th>
                                <th>Thời gian tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
				@foreach ($category as $key => $categories)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $categories->name }}</td>
					<td>
						@if ($categories->parent_id != 0)
							{{ $categories->parent->name }}
						@else
							Không có danh mục cha
						@endif
					</td>
					<td>{{ $categories->user->name }}</td>
					<td>{{ $categories->created_at->format('h:i') }} | {{ $categories->created_at->format('d/m/Y') }}</td>
					<td>
						<a href="#" class="btn btn-dark btn-sm" id="detail" data-bs-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#exampleModal" data-id="{{$categories->id}}" title="Xem chi tiết"><i class="fa fa-eye"></i></a>
						@can('update',$categories)
							<a href="{{ route('category.edit',$categories->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
						@endcan
						@can('delete',$categories )
							<form id="for" action="{{ route('category.destroy',$categories->id) }}" method="POST">
							@csrf
								<a href="#" class="btn btn-danger btn-sm delete-confirm" data-bs-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></a>
							</form>
						@endcan
						
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
							<div class="scroll-y me-n7 pe-7" id="modal_detail_payment">
								
								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Tên danh mục: </p> <span
												id="name_category"></span>
										</div>
									</div>
								</div>

								<div
									class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
									<div class="d-flex align-items-center col-12">
										<div class="ms-5 msi">
											<p
												class="text-muted fw-bolder mb-1 fs-6 msi_2">
												Danh mục cha : </p> <span
												id="parent_category"></span>
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
												id="user_create_category"></span>
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

    <style>
	    #for{
		    display: inline;
	    }
    </style>
@endsection

	@section('script-end')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
	$(document).ready(function() {

		$('.delete-confirm').click(function(event) {
			var form = $(this).closest("form");
			var name = $(this).data("name");
			event.preventDefault();
			swal({
					title: `Bạn có muốn xóa không?`,
					text: "Nếu bạn xóa nó, bạn sẽ không thể khôi phục lại được và các danh mục con thuộc danh mục danh này sẽ mất danh mục cha",
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

		$('.choose_active').change(function(event) {
			event.preventDefault();
			$('#active').submit();
		});

		$(document).on("click", "#detail", function() {
			var id = $(this).data('id');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: '{{ route('category.show') }}',
				method: 'POST',
				dataType: 'JSON',
				data: {
					id: id,
					_token: _token
				},
				success: function(data) {
					$('#name_category').html(data
						.NameCategory);
					$('#parent_category').html(data
						.ParentCategory);
					$('#user_create_category').html(data
						.UserCreateCategory);
				}
			});
		});

	});
	</script>
	@endsection