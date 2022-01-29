@extends('client.layout.master')

@section('main-content')
<style>
#wrapped {
	width: 90%;
	margin: 50px auto;
	padding: 1% 0;
	background-color: #eceff1;
	border-radius: 10px;
}

.info_order {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 0 5%;
}

#progress_order {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 0 5%;
	margin-top: 5%;
}

.progressbar,
.perfect {
	width: 50px;
	height: 50px;
	display: flex;
	justify-content: center;
	align-items: center;
	position: relative;
	border-radius: 50%;
	border: none;
	z-index: 2;
	background-color: #c5cae9;
}

.icon {
	width: 50%;
	height: 50%;
	object-fit: cover;
}

.progressbar:after {
	content: '';
	width: 270px;
	height: 5px;
	position: absolute;
	top: 45%;
	left: 85%;
	background-color: #c5cae9;
	/*z-index: 0;*/
}

.active_order {
	background-color: #18b714;
}

.active_order:after {
	background-color: #18b714;
}

#cancel_order {
	display: block;
	width: 115px;
	margin: auto;
	margin-top: 5%;
	text-align:center;
}

.text_order {
	color: #2B90FC;
}

#li_do{
	outline: none;
   	text-indent: 5px;
}

@media screen and (max-width: 1024px) {
	.progressbar:after {
		width: 200px;
	}
}

@media screen and (max-width: 768px) {
	.progressbar:after {
		width: 150px;
	}
}

@media screen and (max-width: 415px) {
	.progressbar:after {
		width: 60px;
	}

	.progressbar,
	.perfect {
		width: 30px;
		height: 30px;
	}

	.info_order {
		display: block;
	}
}
</style>
@if (count($orders) == 0)
	<p>Hiện không có đơn hàng nào được đặt</p>
@else
@foreach ($orders as $order)
<div id="wrapped">
	<div class="info_order">
		<div id="code_order">
			<h3>Mã đơn hàng : <span class="text_order">#{{ $order->code }}</span></h3>
			<h5>Trạng thái : <span class="text_order">{{ $order->status_text }}</span></h5>
		</div>
		<div id="name_order">
			<p>Ngày đặt : {{ $order->created_at->format('h:i') }} | {{ $order->created_at->format('d/m/Y') }}</p>
			<p>Sản phẩm :  
				@foreach ($order->products as $value)
					<span class="text_order">{{ $value->pivot->name }},</span>
				@endforeach
			</p>
		</div>
	</div>

	<div id="progress_order">
		<div id="confirm_order" class="progressbar {{ $order->status == App\Models\Order::ORDER_WAIT || $order->status == App\Models\Order::ORDER_CONFIRM || $order->status == App\Models\Order::ORDER_SHIPPING || $order->status == App\Models\Order::ORDER_FINISH ? ' active_order' : '' }}">
			<img class="icon" src="https://i.imgur.com/9nnc9Et.png">
		</div>

		<div id="dang_giao_order" class="progressbar {{ $order->status == App\Models\Order::ORDER_CONFIRM || $order->status == App\Models\Order::ORDER_SHIPPING || $order->status == App\Models\Order::ORDER_FINISH ? ' active_order' : '' }}">
			<img class="icon" src="https://i.imgur.com/u1AzR7w.png">
		</div>

		<div id="lozz_order" class="progressbar {{ $order->status == App\Models\Order::ORDER_SHIPPING || $order->status == App\Models\Order::ORDER_FINISH ? ' active_order' : '' }}">
			<img class="icon" src="https://i.imgur.com/TkPm63y.png">
		</div>

		<div id="cc_order" class="perfect {{ $order->status == App\Models\Order::ORDER_FINISH ? ' active_order' : '' }}">
			<img class="icon" src="https://i.imgur.com/HdsziHP.png">
		</div>
	</div>
	@if ($order->status == App\Models\Order::ORDER_WAIT || $order->status == App\Models\Order::ORDER_CONFIRM)
		<a href="#" class="btn btn-danger" id="cancel_order" data-toggle="modal" data-target="#myModal{{$order->id}}">Hủy đơn hàng</a>
	@endif
</div>

<div class="modal fade" id="myModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title">Lí do hủy đơn</h4>
			</div>
			<div class="modal-body">
				<form action="">
					@csrf
					<textarea name="" class="reason" id="li_do" cols="30" rows="10" placeholder="Nhập lý do hủy đơn.... (bắt buộc)" required></textarea>
				
			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
					<button type="button" id="{{ $order->code }}" class="btn btn-success" onclick="Destroy(this.id)">Gửi</button>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach
@endif
@endsection

@section('script-end')
	<script>
			function Destroy(id)
			{
				var id = id;
				var reason = $('.reason').val();
				var _token = $('input[name="_token"]').val();

				// alert(reason);
				$.ajax({
					type: "POST",
					url: "{{ route('order.cancel') }}",
					data: {
						id:id,
						reason:reason,
						_token:_token,
					},
					success: function (data) {
						toastr.success('Đã gửi yêu cầu hủy đơn thành công');
						location.reload();
					}
				});
			}
	</script>	
@endsection