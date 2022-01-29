@extends('client.layout.master')

@section('main-content')
<!-- <section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li></li>
				<li></li>
			</ol>
		</div>
	</div>
</section> -->
<!--/#cart_items-->

<section id="do_action">
	<div class="container">
		<div class="heading">
			<h3>Voucher của tôi</h3>
		</div>
		<div class="row">
			@foreach ($user->haveVouchers as $voucher)
			<div class="col-sm-4 bg_voucher">
				<div class="chose_area">
					<div class="logo_voucher">
						<img src="/frontend/images/home/logo.png" alt="">
					</div>
					<div class="info_voucher">
						<p class="i_voucher">Tên Voucher: <b>{{ $voucher->name }}</b></p>
						<p class="i_voucher">Giảm: <b>{{ $voucher->percent }}%</b> </p>
						<p class="i_voucher">Hạn sử dụng: <b>
							@if ($voucher->expiry < Carbon\Carbon::now()->toDateString())
								Đã hết hạn sử dụng
							@else
								{{ $voucher->expiry }}
							@endif
						</b></p>
					</div>
					<div class="code_voucher">
						<span class="code">Mã giảm giá: <b>{{ $voucher->code }}</b></span>
						<button onclick="copyToClipboard('{{$voucher->code}}')">COPY</button>
					</div>
					
				</div>
			</div>
			@endforeach
			
		</div>
	</div>
</section>
<!--/#do_action-->
<style>

	.bg_voucher{
		background:#dc143c;
		padding: 2%;
	}

	.chose_area{
		width: 100%;
		margin-bottom:0 !important;
		background: white;
    		border: 1px solid white !important;
    		border-radius: 5px;
		display: flex;
		justify-content: space-between;
		align-items: center;
		flex-wrap: wrap;
		padding:0 !important;
	}

	.logo_voucher{
		width: 35%;
		display: flex;
		justify-content: center;
		align-items: center;
		padding: 7% 0;
		padding-right: 2%;
    		border-right: 2px dashed;
	}

	.logo_voucher img{
		width: 100%;
    		height: 100%;
	}

	.info_voucher{
		width: 65%;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		padding-top:5%;
	}

	.code_voucher{
		width: 100%;
		border: 1px solid #80808057;
		border-radius: 5px;
    		padding: 3%;
		display: flex;
		align-items: center;
		justify-content: space-between;
	}

	.i_voucher{
		width: 100%;
		text-align:left;
		text-indent: 5%;
		font-size: 13px;
	}
</style>
@endsection

@section('script-end')
	<script>
		function copyToClipboard(text){
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val(text).select();
			document.execCommand("copy");
			$temp.remove();
			
			toastr.success('Sao chép mã thàng công');
		}
	</script>
@endsection