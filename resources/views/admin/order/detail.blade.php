@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0 text-dark">Chi tiết đơn hàng</h1>
		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="{{ route('order.index') }}">Đơn hàng</a></li>
				<li class="breadcrumb-item active">Chi tiết</li>
			</ol>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>
<div class="container-fluid">
	<!-- Main row -->
	<div class="container">
		<div class="main-body">

			<!-- Breadcrumb -->
			<!-- /Breadcrumb -->

			<div class="row gutters-sm">
				<div class="col-md-4">
					<div class="card mb-3">
						<div class="card-body">
							<button href="#" class="btn btn-primary"
								style="margin-bottom: 20px" type="button">Thông tin
								khách hàng</button>
							<hr>
							<div class="row row_2" data-toggle="tooltip" data-placement="top" title="Mã đơn hàng">
								<div class="col-sm-2 text-center">

									<h6 class="mb-0"><i class="fas fa-qrcode"></i></h6>
								</div>
								<div class="col-sm-10 text-secondary">
									{{ $order->code }}
								</div>
							</div>
							<hr>
							<div class="row row_2" data-toggle="tooltip" data-placement="top" title="Họ và tên khách hàng">
								<div class="col-sm-2 text-center">

									<h6 class="mb-0"><i class="fas fa-user"></i></h6>
								</div>
								<div class="col-sm-10 text-secondary">
									{{ $order->name }}
								</div>
							</div>
							<hr>
							<div class="row row_2" data-toggle="tooltip" data-placement="top" title="Địa chỉ email khách hàng">
								<div class="col-sm-2 text-center">
									<h6 class="mb-0"><i class="fas fa-envelope"></i></h6>
								</div>
								<div class="col-sm-10 text-secondary">
									{{ $order->user->email }}
								</div>
							</div>
							<hr>
							<div class="row row_2" data-toggle="tooltip" data-placement="top" title="Số điện thoại khách hàng">
								<div class="col-sm-2 text-center">
									<h6 class="mb-0"><i class="fas fa-mobile-alt"></i></h6>
								</div>
								<div class="col-sm-10 text-secondary">
									{{ $order->phone }}
								</div>
							</div>
							<hr>
							<div class="row row_2" data-toggle="tooltip" data-placement="top" title="Địa chỉ giao hàng của khách hàng">
								<div class="col-sm-2 text-center">
									<h6 class="mb-0"><i class="fas fa-map-marker-alt"></i></h6>
								</div>
								<div class="col-sm-10 text-secondary">
									{{ $order->address }}
								</div>
							</div>
							<hr>
							<div class="row row_2" data-toggle="tooltip" data-placement="top" title="Phương thức thanh toán">
								<div class="col-sm-2 text-center">
									<h6 class="mb-0"><i class="fas fa-cash-register"></i></h6>
								</div>
								<div class="col-sm-10 text-secondary">
									@if ($order->pay_method == 0)
										Thanh toán bằng tiền mặt
									@elseif ($order->pay_method == 1)
										Thanh toán bằng ví MoMo
									@elseif ($order->pay_method == 2)
										Thanh toán bằng ví ZaloPay (giảm 5%)
									@else
										Thanh toán bằng thẻ ATM
									@endif
								</div>
							</div>
							<hr>
							<div class="row" data-toggle="tooltip" data-placement="top" title="Ghi chú khi giao hàng">
								<div class="col-sm-2 text-center">
									<h6 class="mb-2"><i class="far fa-clipboard"></i></h6>
								</div>
								<div class="col-sm-10 form-outline mb-4">
									<textarea disabled class="form-control"
										id="form4Example3"
										rows="4">{{ $order->note }}</textarea>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<ul class="nav nav-pills">
								<li class="nav-item"><button class="btn btn-primary">Chi
										tiết đơn hàng</button></li>
							</ul>
						</div><!-- /.card-header -->
						<div class="card-body">
							<div class="tab-content">
								<div class="active tab-pane" id="product">
									<div class="card-body table-responsive p-0">
										<table class="table table-hover">
											<thead>
												<tr class="bg-primary">
													<th>Tên sản phẩm</th>
													<th  class="text-center">Ảnh</th>
													<th class="text-center">Số lượng</th>
													<th>Đơn giá</th>
													<th>Thành tiền</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($order->products as $value)
													<tr>
														<td>{{ $value->pivot->name }}</td>
														<td class="text-center"><img style="width: 40px;" src="{{ $value->images[0]->image_url  }}" alt=""></td>
														<td class="text-center">{{ $value->pivot->quantity }}</td>
														<td>{{ number_format($value->pivot->price) }} VNĐ</td>
														<td>
															{{ number_format($value->pivot->price * $value->pivot->quantity) }} VNĐ
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
									<br>
									<hr>
									<div class="row">
										<div class="col-6">
											@if ($order->status == App\Models\Order::ORDER_WAIT)
												<span style="background-color: rgb(247, 65, 65);padding: 5px 10px;color:white;font-weight: bold;border-radius: 10px">
												Chưa xử lý<i class="fas fa-spinner" style="margin-left: 5px;"></i>
												</span>    
											@elseif($order->status == App\Models\Order::ORDER_CONFIRM)
												<span style="background-color: rgb(28, 49, 243);padding: 5px 10px;color:white;font-weight: bold;border-radius: 10px">
												Đã xác nhận<i class="fas fa-thumbs-up" style="margin-left: 5px;"></i>
												</span>
											@elseif($order->status == App\Models\Order::ORDER_SHIPPING)
												<span  style="background-color: yellow;padding: 5px 10px;color:rgb(19, 95, 209);font-weight: bold;border-radius: 10px">
												Đang giao hàng<i class="fas fa-motorcycle" style="margin-left: 5px;"></i>
												</span>
											@elseif($order->status == App\Models\Order::ORDER_FINISH)
												<span style="background-color:green;padding: 5px 10px;color:white;font-weight: bold;border-radius: 10px">
												Đã hoàn thành <i class="fas fa-check-circle" style="margin-left: 5px;"></i>
												</span>
											@else
												<span style="background-color:green;padding: 5px 10px;color:white;font-weight: bold;border-radius: 10px">
												Đã hủy đơn <i class="fas fa-check-circle" style="margin-left: 5px;"></i>
												</span>
											@endif
										</div>
										<div class="col-6"
											style="text-align: right">
											<p>
												<b class="text-primary">Tổng
													tiền:</b>
												<b> {{ number_format($order->total_price) }} VNĐ</b>
											</p>
										</div>
									</div>
									</form>
								</div>
							</div>
							<!-- /.tab-content -->
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

</div>
<style>
	.row_2{
		display: flex;
		justify-content: center;
		align-items:center;
	}

	#form4Example3{
		resize:none;
	}
</style>
@endsection

@section('script-end')
	<script>
		$(document).ready(function(){
			$(function() {
				$('[data-toggle="tooltip"]').tooltip()
			});
		});
	</script>
@endsection