<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Anwarul Islam & Sons</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="{{ asset('vali/css/jquery-ui.css') }}" type="text/css" rel="stylesheet" />
    <!-- Styles -->
    <!-- <link href="{{ asset('vali/css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('vali/css/toastr.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet">
    <link href="{{ asset('vali/css/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vali/css/filter-table.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/pm/gijgo@1.9.4/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="{{ asset('vali/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('vali/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('vali/css/responsive.css')}}">
    <style type="text/css" media="all">
	    
		#page-wrapper {
			margin: 0px 0px 0px 0px;
			padding: 0px 0px;
		}
	 	@media print{
			.with_print{
	            display: none;
	        }
	        .page-break	{
				display: block; 
				page-break-before: auto;		
			}
			.container{
				width: 100%;
				padding-right: 0px;
    			padding-left: 0px;
			}
	    }
    </style>
</head>


<body>
	<div id="wrapper">
		<div id="page-wrapper">
			<div class="container">
				
				<div class="row with_print">
					<div class="col-md-6 m-bottom-25">
						<h3 class="page-header">Print Barcode</h3>
					</div>
					<div class="col-md-6">
						<div class="text-right m-top-25">

							<button class="btn btn-success with_print" name="print" onclick="window.print()"><i class="fa fa-print"></i> Print</button>

							<a class="btn btn-danger" type="submit" href="{{ route('barcode.destroyPrintBarcode') }}"></i> Back</a>

						</div>
					</div>
				</div>	
				<div class="row" id="">
					<div class="col-md-12 col-xs-12">
						<div class="page-break barcodeDiv"></div>	
					</div>
				</div>
				
				<div class="row">
					<div style="display:none">{{ $j = 0 }}</div>
					@foreach ($items as $item)
						@for($i=1; $i <= $item->qty; $i++)
						<div class="col-md-2 col-xs-2 col-sm-2" style="font-size:12px;padding:2px;margin-bottom:1.7px;font-weight:700;text-align:center !important;">
							<div class="card" style="margin-bottom:0px;border-radius:0px;">
								<p style="text-align:center;margin:0px;font-size:12px;font-weight:700;">{{ ucwords(\App\Shop::where('id', Auth::user()->shop_id)->first()->name) }}</p>
								<p style="text-align:center;margin:0px;font-size:12px;font-weight:700;" class="text-center;">{{ $item->name }}</p>
								<p style="text-align:center;margin:0px;font-size:12px;font-weight:700;">BDT. {{ $item->price }}</p>
								<p style="text-align:center;margin:0px;font-size:12px;font-weight:700;"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($item->options['productBarcode'], "C128", 1,20)}}" alt="barcode" /></p>
								<p style="text-align:center;margin:0px;font-size:12px;font-weight:700;">{{ $item->options['productBarcode'] }}</p>
								<div style="display:none">{{ ++$j }}</div>
							</div>
						</div>
						@if( $j%90==0)
							<div class="page-break"></div>
						@endif
						@endfor
					@endforeach
				</div>

			</div>
		</div>
    </div>

	<script src="{{ asset('vali/js/jquery-3.3.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('vali/js/popper.min.js') }}" defer></script>
    <script type="text/javascript" language="javascript" src="{{ asset('vali/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('vali/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('vali/js/toastr.min.js') }}"></script>
    <script src="{{ asset('vali/js/filter-table.js') }}"></script>
    <!-- =========New JS Files======== -->
    <script src="{{ asset('vali/js/plugins/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('vali/js/plugins/moment.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script src="{{ asset('vali/js/plugins/sweetalert.min.js')}}"></script>
    <script src="{{ asset('vali/js/plugins/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('vali/js/plugins/pace.min.js')}}"></script>
    <!-- =========New JS Files======== -->
    <script src="{{ asset('vali/js/main.js')}}"></script>
    <script type="text/javascript">
       
		$(window).on("load", function(){
		  window.print();
		});
    </script>
</body>
</html>

