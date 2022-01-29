@extends('admin.layout.master')

@section('main-content')
<!-- Content Wrapper. Contains page content -->

	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
					</ol>
				</div><!-- /.col -->
			</div>
		</div>
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3>{{ count($orders) }}</h3>

							<p>Đơn hàng</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="#" class="small-box-footer">Xem thêm <i
								class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h3>{{ count($products) }}</h3>

							<p>Sản phẩm</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="#" class="small-box-footer">Xem thêm <i
								class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-primary">
						<div class="inner">
							<h3>{{ count($staff) }}</h3>

							<p>Nhân viên</p>
						</div>
						<div class="icon">
							<i class="fa fa-users" aria-hidden="true"></i>
						</div>
						<a href="#" class="small-box-footer">Xem thêm <i
								class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3>{{ count($users) }}</h3>

							<p>Người dùng</p>
						</div>
						<div class="icon">
							<i class="fa fa-user-plus" aria-hidden="true"></i>
						</div>
						<a href="#" class="small-box-footer">Xem thêm <i
								class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3>{{ number_format($profit) }} VNĐ</h3>

							<p>Lợi nhuận</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="#" class="small-box-footer">Xem thêm <i
								class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-dark">
						<div class="inner">
							<h3>{{ count($categories) }}</h3>

							<p>Danh mục</p>
						</div>
						<div class="icon">
							<i class="fa fa-tree"></i>
						</div>
						<a href="#" class="small-box-footer">Xem thêm <i
								class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-light">
						<div class="inner">
							<h3>{{ count($tag) }}</h3>

							<p>Thẻ</p>
						</div>
						<div class="icon">
							<i class="fa fa-tag"></i>
						</div>
						<a href="#" class="small-box-footer">Xem thêm <i
								class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<form action="" autocomplete="off">
				@csrf
			</form>
			<div class="row">
				<div class="col-lg-6 col-6" style="background: white;">
					<div class="card-header statis-14-day">
						<h3 class="card-title" style="font-weight:bold">Thống kê 14 ngày gần nhất</h3>
					</div>
					<div id="myfirstchart"></div>
				</div>

				
				<div class="col-lg-6  col-6 chart_right">
					<div class="chart-container" id="donut">
						
					</div>
				</div>
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Sản phẩm mới nhập</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Tên sản phẩm</th>
										<th>Danh mục</th>
										<th>Trạng thái</th>
										<th>Thời gian</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($new as $key => $value)
									<tr>
										<td>{{ $key+1 }}</td>
										<td>{{ $value->name }}</td>
										<td>
											@if ($value->category_id == 0)
												Không có danh mục
											@else
												{{ $value->category->name }}
											@endif
											

										</td>
										<td>
										@if($value->status == 0)
											<span class="badge badge-primary">{{ $value->status_text }}
											</span>
										@elseif($value->status == 1)
											<span class="badge badge-dark">{{ $value->status_text }}
											</span>
										@else
											<span class="badge badge-danger">{{ $value->status_text }}</span>
										@endif
										</td>
										<td>
											{{ $value->created_at->format('d/m/Y') }}
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="container1">
								<div class="plane">
									<img src="/backend/dist/img/plane-removebg-preview.png" alt="">
								</div>
								<div id="MyClockDisplay" class="clock" onload="showTime()"></div>
							</div>
						</div>

						<div class="col-lg-6 col-12 container_dycalendar">
							<div class="container2">
								<div id="dycalendar"></div>
							</div>
						</div>
					</div>
					

					
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
	<style>
					#myfirstchart{
						height: 350px;
						background: white;
    						box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
    						margin-bottom: 1rem;
					}

					.statis-14-day{
						background-color: transparent;
    						border-bottom: 1px solid rgba(0,0,0,.125);
   						padding: .75rem 1.25rem;
    						position: relative;
    						border-top-left-radius: .25rem;
    						border-top-right-radius: .25rem;
					}

					.chart_right{
						/* display: inline-flex; */
						align-items: end;
						padding: 15px 0;
					}
					
					.container1{
						position: relative;
						width: 100%;
						padding:10% 0 15% 0;
						background:black;
						margin: 5% 0;
						box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
						overflow: hidden;
					}

					.clock {
						width: 100%;
						position: absolute;
						/* top: 50%; */
						left: 75%;
						transform: translateX(-50%) translateY(-50%);
						color: #17D4FE;
						font-size: 30px;
						font-family: Orbitron !important;
						letter-spacing: 7px;
						-webkit-box-reflect: below 0px linear-gradient(transparent, #17d4fe99);
					}

					.plane{
						width: 100px;
						height: 100px;
						position: absolute;
						top: 0;
						right: -5%;
						animation: ani 20s infinite linear;
					}

					.plane img{
						width: 100%;
						height: 100%;
					}

					@keyframes ani {
						0%{
							right: -20%;
						}

						100%{
							right: 100%;
						}
					}

					.container_dycalendar{
						display: flex;
						justify-content:center;
						align-items:center;
						padding:10px;
						background:#161623;
					}

					.container2{
						display: flex;
						justify-content: center;
						align-items:center;
						width: 300px;
						min-height:200px;
						background:rgba(255, 255, 255, 0.1);
						box-shadow: 0 25px 45px rgba(0,0,0,0.1);
						border:1px solid rgba(255, 255, 255, 0.5);
						border-right:1px solid rgba(255, 255, 255 ,0.2);
						border-bottom:1px solid rgba(255, 255, 255 ,0.2);
						border-radius:10px;
						backdrop-filter: blur(25px);
						color: white;
    						font-weight: bold;
					}
	</style>
@endsection

@section('script-end')
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
	 var colorDanger = "#FF1744";
            Morris.Donut({
                element: 'donut',
                resize: true,
                colors: [
                    '#E0F7FA',
                    '#80DEEA',
                    '#26C6DA',
                    '#00ACC1',
                    '#00838F',
                ],
                data: [
                    {label: "Sản phẩm đang bán", value: {{ count($on_sale) }}, color:"yellow",},
                    {label: "Sản phẩm hết hàng", value: {{ count($out_of_stock) }}},
                    {label: "Sản phẩm dừng bán", value: {{ count($stop_sale) }}, color: colorDanger},
                ]
            });
</script>
<script>
	var chart = new Morris.Area({
		// ID of the element in which to draw the chart.
		element: 'myfirstchart',
		// Chart data records -- each entry in this array corresponds to a point on
		// the chart.
		// The name of the data record attribute that contains x-values.
		xkey: 'period',
		// A list of names of data record attributes that contain y-values.
		ykeys: ['profit'],

		lineColors:['#ff6384'],

		resize:true,
		// Labels for the ykeys -- will be displayed when you hover over the
		// chart.
		labels: ['Lọi nhuận'],
	});
</script>
<script>
	$(document).ready(function () {
		TwoWeeks();

		function TwoWeeks(){
			var _token = $('input[name="_token"]').val();

			$.ajax({
				type: "POST",
				url: "{{route('statis.twoweeks')}}",
				data: {
					_token:_token,
				},
				dataType: "JSON",
				success: function (data) {
					chart.setData(data);
				},
				error: function()
				{
					var data = [
						{period:'' , profit:0}
					];
					chart.setData(data);
				}
			});
		}
	});
</script>
<script>
	function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

showTime();
</script>
<script>
	dycalendar.draw({
		target: '#dycalendar',
		monthformat: 'full',
		highlighttargetdate: true,
		// dayformat: 'full',
		// prevnextbutton: 'show',
	})
</script>
@endsection