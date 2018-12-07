@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Return Report</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Report</li>
        <li class="breadcrumb-item">Return Report</li>
    </ul>
</div>

<section class="m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                </div>
                <div class="card-body">
                	<form action="{{ route('returnReport') }}" method="post">
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
                    <h4 class="text-white">{{ $heading }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					  <thead class="bg-dark text-white">
					    <tr>
					      <th scope="col">Return ID</th>
					      <th scope="col">Date</th>
					      <th scope="col">Returned Item</th>
					      <th scope="col">Returned Total</th>
					      <th scope="col">Sale Item</th>
					      <th scope="col">Sale Total</th>
					      <th scope="col">Profit</th>
					      <th scope="col">View</th>
					    </tr>
					  </thead>
					  <tbody>
							@if($returnProducts->count() > 0)
						    	@foreach($returnProducts as $returnProduct)
						    	<tr>
							      <td>{{ $returnProduct->id }}</td>
							      <td>{{ $returnProduct->created_at->format('d-m-Y, h:i a') }}</td>
							      <td>{{ $returnProduct->returned_item }}</td>
							      <td>{{ $returnProduct->returned_total_bill }}</td>
							      <td>{{ $returnProduct->sale_item }}</td>
							      <td>{{ $returnProduct->sale_total_bill }}</td>
							      <td>{{ $returnProduct->profit }}</td>
							      <td>
							      	<a href="{{ route('viewReturn', ['id'=>$returnProduct->id]) }}" class="btn btn-dark btn-sm">
							      		<i class="fas fa-info-circle"></i>
							      	</a>
							      </td>
						    	</tr>
						    	@endforeach
						    @else
	                            <tr>
	                                <td colspan="8" class="text-center">
	                                    <div class="alert alert-danger" role="alert">
	                                      No Return Found
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