@extends('admin.layout.master')

@section('main-content')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">

		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dash.admin') }}">Trang chủ</a></li>
				<li class="breadcrumb-item active">Thống kê</li>
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
					<h3 class="card-title">Thống kê</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body table-responsive p-0">
					
						<form action="" autocomplete="off">
						@csrf
						<div class="row m-0">
							<div class="col-sm-4 col-4">
								<span>Từ ngày :</span> <input type="text" class="form-control" id="date">
							</div>
							<div class="col-sm-4 col-4">
								<span>Đến ngày :</span> <input type="text" class="form-control" id="date2">
							</div>
							<div class="col-sm-4 col-4">
								<p>Lọc theo: 
								<select name="" id="my-select" data-live-search="true" class="dashboard-filter form-control" id="">
									<option >-Chọn-</option>
									<option value="7ngay" data-date="7 ngày qua">7 ngày qua</option>
									<option value="thangtruoc" data-date="tháng trước">Tháng trước</option>
									<option value="thangnay" data-date="tháng này">Tháng này</option>
									<option value="365ngayqua" data-date="1 năm">365 ngày qua</option>
								</select>
								</p>
							</div>
							<div class="col-3">
								<input type="button" class="btn btn-primary mt-2" id="sub" value="Lọc">
							</div>
							<div class="col-5"></div>
							<div class="col-4">
								<?php $years = range(2000, strftime("%Y", time())); ?>
								<select id="filterYear" class="form-control">
									<option>-Lọc theo năm-</option>
										<?php foreach($years as $year) : ?>
											<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
										<?php endforeach; ?>
								</select>
							</div>
						</div>	
						</form>
						
					
				</div>
				<!-- /.card-body -->

				<div class="col-12">
					<div id="myfirstchart" style="height: 250px;"></div>
				</div>

				<div class="col-12">
					<table border="1">
						<thead>
							<th class="text-center">Số lượng bán</th>
							<th class="text-center">Lợi nhuận</th>
							<th class="text-center">Tổng đơn hàng</th>
						</thead>
						<tbody>
							<tr>
								<td id="quantity" class="text-center"></td>
								<td id="profit" class="text-center"></td>
								<td id="sales" class="text-center"></td>
							</tr>
						</tbody>
					</table>
                                </div>
			</div>
			<style>
				table{
					width: 100%;
				}
			</style>
			<!-- /.card -->
			
		</div>
	</div>
	<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection
@section('script-end')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	
	<script>
  	$( function() {
    		$( "#date" ).datepicker({
			prevText:"Tháng trước",
			nextText:"Tháng sau",
			dateFormat:"yy-mm-dd",
			dayNamesMin: [ ' Chủ Nhật ',' Thứ 2 ',' Thứ 3 ',' Thứ 4 ',' Thứ 5 ',' Thứ 6 ',' Thứ 7 ' ],
			monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4",
                   				"Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9",
                   				"Tháng 10", "Tháng 11", "Tháng 12" ],
		});
    		
		$( "#date2" ).datepicker({
			prevText:"Tháng trước",
			nextText:"Tháng sau",
			dateFormat:"yy-mm-dd",
			dayNamesMin: [ ' Chủ Nhật ',' Thứ 2 ',' Thứ 3 ',' Thứ 4 ',' Thứ 5 ',' Thứ 6 ',' Thứ 7 ' ],
			monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4",
                   				"Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9",
                   				"Tháng 10", "Tháng 11", "Tháng 12" ],	
		});
  	});
  </script>

	<script>
		var chart = new Morris.Bar({
			element: 'myfirstchart',
			
  			parseTime: false,
  			hideHover: 'auto',
                	resize: true,
			fillOpacity: 0.6,
			barSize: 50,
			xkey: 'period',
			ykeys: ['profit','quantity'],
			behaveLikeLine: true,
			labels: ['Lợi nhuận','Số lượng bán'],
      			barColors:['#29abe2','#ff6384'],
		});
	</script>

  <script>
		$(document).ready(function(){
			var formatter = new Intl.NumberFormat('vi-VN', {
			style: 'currency',
			currency: 'VND',
			minimumFractionDigits: 0,
		});

			$("#sub").click(function(){
				var _token = $('input[name="_token"]').val();

				var from_date = $('#date').val();

				var to_date = $('#date2').val();

				if(from_date >= to_date)
				{
					alert("Ngày trước phải nhỏ hơn ngày sau ! Xin vui lòng chọn lại !");
				}else{
					$.ajax({
						type: "POST",
						url: "{{route('statis.filter-by-date')}}",
						data: {
							from_date:from_date,
							to_date:to_date,
							_token:_token,
						},
						dataType: "JSON",
						success: function (data) {
							chart.setData(data);
							var quantity = 0;
							var profit = 0;
							var order = 0
							for (var i = 0; i < data.length; i++) {
								order += data[i]['order'];
								profit += data[i]['profit'];
								quantity += data[i]['quantity'];
							}
								
							$('#quantity').empty();
							$('#quantity').append(quantity);
							$('#profit').empty();
							$('#profit').append(formatter.format(profit));
							$('#sales').empty();
							$('#sales').append(order);
						},

						error: function() {
							var quantity = 0;
							var order = 0;
							var profit = 0;
							$('#quantity').text(quantity);
							$('#sales').text(order);
							$('#profit').text(profit);
							swal("Không có đơn hàng nào được đặt từ " + from_date + " đến " + to_date + "!");
							var data = [
								{ period: '', profit: 0 },
							];
							chart.setData(data);
							
							$('#quantity').empty();
							$('#quantity').append(quantity);
							// alert("Không có đơn hàng nào được đặt từ " + from_date + " đến " + to_date + "!");
						},
					});
				}
			}); // End from -> to

			OneMonth();

			function OneMonth()
			{
				var _token = $('input[name="_token"]').val();

				$.ajax({
					type: "POST",
					url: "{{route('statis.onemonth')}}",
					data: {
						_token:_token
					},
					dataType: "JSON",
					success: function (data) {
						chart.setData(data);
						var quantity = 0;
						var profit = 0;
						var order = 0
						for (var i = 0; i < data.length; i++) {
							order += data[i]['order'];
							profit += data[i]['profit'];
							quantity += data[i]['quantity'];
						}
							
						$('#quantity').empty();
						$('#quantity').append(quantity);
						$('#profit').empty();
						$('#profit').append(formatter.format(profit));
						$('#sales').empty();
						$('#sales').append(order);
					},
					error:function(){
						// alert("Không có đơn hàng nào được đặt trong một tháng qua!");
						var quantity = 0;
						var orders = 0;
						var profit = 0;
						$('#quantity').text(quantity);
						$('#sales').text(order);
						$('#profit').text(profit);
						swal("Không có đơn hàng nào được đặt trong một tháng qua!");
						var data = [
							{ period: '', profit: 0 },
						];
						chart.setData(data);
					}
				});
			}

		$('.dashboard-filter').change(function(){
			var dashboard_value = $(this).val();
			var data_date = $(this).find(':selected').attr('data-date');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url:"{{ route('statis.statisticalfilterday') }}",
				method:"POST",
				dataType:"JSON",
				data:{dashboard_value:dashboard_value,_token:_token},
				success:function(data)
				{
					chart.setData(data);
					var quantity = 0;
					var profit = 0;
					var order = 0
					for (var i = 0; i < data.length; i++) {
						order += data[i]['order'];
						profit += data[i]['profit'];
						quantity += data[i]['quantity'];
					}
						
					$('#quantity').empty();
					$('#quantity').append(quantity);
					$('#profit').empty();
					$('#profit').append(formatter.format(profit));
					$('#sales').empty();
					$('#sales').append(order);
				},
				error:function () {
					
					var quantity = 0;
					var profit = 0;
					var order = 0
					$('#quantity').text(quantity);
					$('#profit').text(profit);
					$('#sales').text(order);
					// alert("Không có đơn hàng nào được đặt trong " + dashboard_value + " qua!");
					swal("Không có đơn hàng nào được đặt trong " + data_date + " qua!");
					var data = [
						{ period: '', profit: 0 },
					];
					chart.setData(data);
				}
			});
		});

		$('#filterYear').change(function(){
			var year = $(this).val();
			var _token = $('input[name="_token"]').val();

			$.ajax({
				type: "POST",
				url: "{{ route('statis.statisticalfilteryear') }}",
				data: {
					year:year,
					_token:_token,
				},
				dataType: "JSON",
				success: function (data) {
					chart.setData(data);
					var quantity = 0;
					var profit = 0;
					var order = 0
					for (var i = 0; i < data.length; i++) {
						order += data[i]['order'];
						profit += data[i]['profit'];
						quantity += data[i]['quantity'];
					}
						
					$('#quantity').empty();
					$('#quantity').append(quantity);
					$('#profit').empty();
					$('#profit').append(formatter.format(profit));
					$('#sales').empty();
					$('#sales').append(order);
				},
				error: function()
				{
					var quantity = 0;
					var profit = 0;
					var order = 0
					$('#quantity').text(quantity);
					$('#profit').text(profit);
					$('#sales').text(order);
					// alert("Không có đơn hàng nào được đặt trong " + dashboard_value + " qua!");
					swal("Không có đơn hàng nào được đặt trong năm " + year + "!");
					var data = [
						{ period: '', profit: 0 },
					];
					chart.setData(data);
				}
			});
		});

	}); //End ready
	</script>
@endsection