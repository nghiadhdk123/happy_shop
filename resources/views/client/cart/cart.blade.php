@extends('client.layout.master')

@section('main-content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li></li>
				<li></li>
			</ol>
		</div>
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Ảnh sản phẩm</td>
						<td class="description">Tên sản phẩm</td>
						<td class="price">Giá</td>
						<td class="quantity">Số lượng</td>
						<td class="total">Tổng tiền</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@if (count($items) == 0)
						<td colspan="6" id="no-items">
							<img src="/frontend/images/tiki.png" alt="">
							<h3>Hiện không có sản phẩm nào trong giỏ hàng của bạn.</h3>		
						</td>
					@else
					@foreach ($items as $item)
					<tr class="cart_{{$item->rowId}} cart_reload">
						<td class="cart_product">
							<a href=""><img src="{{ $item->options->image }}" alt=""></a>
						</td>
						<td class="cart_description">
							<h4><a href="">{{ $item->name }}</a></h4>
							<!-- <p>Web ID: 1089772</p> -->
						</td>
						<td class="cart_price">
							<p>{{ number_format($item->price) }} VNĐ</p>
						</td>
						<td class="cart_quantity">
								<input class="cart_quantity_input" type="number"
									name="quantity" value="{{ $item->qty }}" autocomplete="off"
									size="2" min="1" max="{{ $item->options->quantity }}" onchange="updateNumber(this.value,'{{ $item->rowId }}',this.max)">
						</td>
						<td class="cart_total">
							<p class="cart_total_price">{{ number_format($item->total) }} VNĐ</p>
						</td>
						<td class="cart_delete">
							<form action="" method="POST">
								@csrf
								<a class="cart_quantity_delete delete-cart" data-delete="{{ $item->rowId }}"><i class="fa fa-times"></i></a>
							</form>
							
						</td>
					</tr>
					@endforeach
					@endif
					<tr>
						<td colspan='2'>
							@if (count($items) > 0)
							<form action="{{ route('code-voucher') }}" id="form_code" method="POST">
							@csrf
								<input type="text" id="in_code" placeholder="Nhập mã giảm giá(nếu có)" name="code" class="form-control">
								<button class="btn btn-default" type="submit">Nhập mã</button>
							</form>
							@endif
						</td>
						<td colspan='4' class="col_pay">
							@if (count($items) > 0)
								<a href="#do_action" class="btn btn-default update pay">Thanh Toán</a>
								<a class="btn btn-default update pay" id="updateCart">Cập nhật giỏ hàng</a>
							@endif
							<a href="{{ route('home') }}" class="btn btn-default update pay">Tiếp tục mua hàng</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>
<!--/#cart_items-->
@if (count($items) > 0)
<section id="do_action">
	<div class="container">
		<div class="heading">
			<h3>Thanh toán đơn hàng</h3>
			<p>Note(*) : Bạn phải <a href="">đăng nhập</a> tài khoản của mình trước khi thanh toán đơn hàng của mình !</p>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="chose_area">
					<form action="{{ route('pay.cart') }}" method="POST">
					@csrf
						<ul class="user_option">
							<li>
								<label>Tên người nhận <span class="required">*</span></label>
								<input type="text" name="name" class="form-control" placeholder="Nhập tên người nhận">
							</li>
							<li>
								<label>Số điện thoại <span class="required">*</span></label>
								<input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại">
							</li>
							<li>
								<label>Địa chỉ <span class="required">*</span></label>
								<input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ giao hàng">
							</li>
							<li>
								<label>Phương thức thanh toán</label>
									<ul id="payment_methods">
										<li class="methods">
											<input type="radio" name="pay_method" checked value="0">
											<img src="/frontend/images/money.png" alt="" class="payments">
											<label>Thanh toán tiền mặt khi nhận hàng</label>
										</li>
										<li class="methods">
											<input type="radio" name="pay_method" value="1">
											<img src="/frontend/images/momo.png" alt="" class="payments">
											<label>Thanh toán bằng ví MoMo</label>
										</li>
										<li class="methods">
											<input type="radio" name="pay_method" value="2">
											<img src="/frontend/images/zalopay.png" alt="" class="payments">
											<label>Thanh toán bằng ví ZaloPay <span class="badge badge-primary">Giảm 5%</span></label>
										</li>
										<li class="methods">
											<input type="radio" name="pay_method" value="3">
											<img src="/frontend/images/atm.png" alt="" class="payments">
											<label>Thanh toán thẻ ATM nội địa/Internet Banking(Hỗ trợ Internet Banking)</label>
										</li>
									</ul>
							</li>
							<li>
								<label>Ghi chú</label>
								<textarea name="note" id="" cols="30" rows="10" class="form-control" placeholder="Ghi chú khi giao hàng"></textarea>
							</li>
						</ul>
						<button type="submit" class="btn btn-default update pay btn_pay">Đặt hàng</button>
						<p id="text_note">(Vui lòng kiểm tra lại đơn hàng trước khi đặt mua.)</p>
					</form>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="total_area">
					<h4 id="info_order">Thông tin hóa đơn</h4>
					<ul>
						@if (Session::get('code_voucher'))
							@foreach (Session::get('code_voucher') as $key => $vou)
								<li>Mã giảm giá <span>@php
									echo $vou['code'];
								@endphp</span></li>
								<li>Giảm <span>@php
									echo $vou['percent'];
								@endphp%</span></li>
							@endforeach
						@endif
						
						<li>Số lượng sản phẩm <span>{{ Cart::count() }}</span></li>
						<li>Thuế <span>0 VNĐ</span></li>
						<li>Giá vận chuyển<span>Free</span></li>
						<li>Tông tiền ban đầu <span>{{ number_format(Cart::total()) }} VNĐ</span></li>
						<li>Tổng tiền chính <span>
							@if (Session::get('code_voucher'))
								@foreach (Session::get('code_voucher') as $key => $vou)
									@php
										$total = Cart::total() - (Cart::total()*$vou['percent']/100);
										echo number_format($total);
									@endphp VNĐ
								@endforeach
							@else
								{{ number_format(Cart::total()) }} VNĐ
							@endif
						</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
@endif
<!--/#do_action-->
<style>
	html {
  		scroll-behavior: smooth;
	}	
	.pay{
		padding: 15px 15px !important;
	}

	.col_pay{
		text-align:right;
	}

	#info_order{
		margin: 0 0 5% 7%;
	}

	.delete-cart{
		cursor: pointer;
	}

	#no-items{
		text-align: center;
    		padding: 5% 0;
	}

	label{
		margin-left:0px !important
	}

	#payment_methods{
		border: 1px solid #e6e4df;
   		padding: 15px 0 15px 15px;
	}

	.payments{
		width: 20px;
		height: 20px;
		object-fit:cover;
		margin: 0 2%;
	}

	li{
		margin: 3% 0;
	}

	.required{
		color:red;
	}

	.methods{
		display: flex;
	}

	.btn_pay{
		width: 150px;
	}

	#text_note{
		margin: 10px 0px 0px 40px;
	}

	#in_code{
		height: 45px;
    		margin-right: 3%;
	}

	#form_code{
		display: flex;
    		padding: 15px 15px !important;
    		margin-top: 18px;
	}

	.cart_quantity_input{
		width: 50px;
	}
</style>
@endsection
@section('script-end')
	<script>
		$(document).ready(function () {
			$('.delete-cart').click(function(){
				var id = $(this).data('delete');
				var _token = $('input[name="_token"]').val();
				// alert(id);

				$.ajax({
					type: "POST",
					url: "{{route('delete.cart')}}",
					data: {
						_token:_token,
						id:id,
					},
					success: function () {
						$('.cart_'+id).remove();
						location.reload()
						
					},
					error: function(){
						console.log('Can not remove');
					}
				});
			});

			$('#updateCart').click(function(){
				location.reload()
			});
		});
	</script>
	<script>
		function updateNumber(qty,rowId,max)
			{
				if(qty == max)
				{
					toastr.error('Đã tới giới hạn số lượng sản phẩm');
				}
				$.get(
					'{{ asset('cart/updateNumber') }}', {qty:qty,rowId:rowId},
					function(){},
					
				);
			}
	</script>
@endsection