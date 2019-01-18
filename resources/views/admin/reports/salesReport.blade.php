@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Sales Report</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Report</li>
        <li class="breadcrumb-item">Sales Report</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                </div>
                <div class="card-body">
                	<form action="{{ route('salesReport') }}" method="post">
                		{{ csrf_field() }}
	                    <div class="row">
	                    	<div class="col-md-6 form-group">
								<label>Date From</label>
								<input type="text" id="startDate" class="form-control datepicker" name="date_from" value="{{ old('') }}"/>
								@if ($errors->has('date_from'))
	                                <span class="invalid-feedback">
	                                    <strong>{{ $errors->first('date_from') }}</strong>
	                                </span>
	                            @endif
							</div>
	                    	<div class="col-md-6 form-group">
								<label>Date To</label>
								<input class="form-control datepicker" name="date_to" value="{{ old('') }}">

								@if ($errors->has('date_to'))
	                                <span class="invalid-feedback">
	                                    <strong>{{ $errors->first('date_to') }}</strong>
	                                </span>
	                            @endif
							</div>
							<div class="col text-right">
								<button class="btn btn-primary" name="dateRangeSubmit">Search</button>
							</div>
	                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row p-t-50">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h4 class="text-white">{{ $heading }}<span class="float-right">Total Sale: {{ $totalSale }}, Paid Amount: {{ $paidAmount }}, Total Profit: {{ $totalProfit }}  </span> </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					  <thead class="bg-dark text-white">
					    <tr>
					      <th scope="col">Sale ID</th>
					      <th scope="col">Date</th>
					      <th scope="col">Item</th>
					      <th scope="col">Total Amount</th>
					      <th scope="col">Paid</th>
					      <th scope="col">Profit</th>
					      <th scope="col">View</th>
					    </tr>
					  </thead>
					  <tbody>
							@if($sales->count() > 0)
						    	@foreach($sales as $sale)
						    	<tr>
							      <td>{{ $sale->id }}</td>
							      <td>{{ $sale->created_at->format('d-m-Y, h:i a') }}</td>
							      <td>{{ $sale->items }}</td>
							      <td>{{ $sale->subTotal + $sale->additionalCost - $sale->discount }}</td>
							      <td>{{ $sale->paidAmount }}</td>
							      <td>{{ $sale->profit }}</td>
							      <td>
							      	<a href="{{ route('viewSale', ['id'=>$sale->id]) }}" class="btn btn-dark btn-sm">
							      		<i class="fas fa-info-circle"></i>
							      	</a>
							      </td>
						    	</tr>
						    	@endforeach
						    @else
                         <tr>
                             <td colspan="7" class="text-center">
                                 <div class="alert alert-danger" role="alert">
                                   No Sale Found
                                 </div>
                             </td>
                         </tr>
                     @endif
					  </tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection