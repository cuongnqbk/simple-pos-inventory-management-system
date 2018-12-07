@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-amazon-pay"></i> ALL CASH IN OUTS</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Cash</li>
        <li class="breadcrumb-item">All Cash In Outs</li>
    </ul>
</div>

<section class="allExpense-part m-t-80">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('cashInOut.create') }}" role="button">
                    	Add Cash In Out
                    </a>
                </div>
                <form action="{{ route('receivePayments') }}" method="post">
                <div class="card-body">
                    <div class="row">
                        {{ csrf_field() }}
                        	<div class="col-md-6 form-group">
    							<label>Date From</label>
    							<input class="form-control datepicker" name="receive_date_from">
                                @if ($errors->has('receive_date_from'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('receive_date_from') }}</strong>
                                    </span>
                                @endif
    						</div>
                        	<div class="col-md-6 form-group">
    							<label>Date To</label>
    							<input class="form-control datepicker" name="receive_date_to">
                                @if ($errors->has('receive_date_to'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('receive_date_to') }}</strong>
                                    </span>
                                @endif
    						</div>
    						<div class="col text-right">
    							<button class="btn btn-primary" type="submit">Search</button>
    						</div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row p-t-50 m-b-50">
        <div class="col">
            <div class="card border-dark filterable">
                <div class="card-header text-right bg-dark">
                    <button id="filter_button" class="btn btn-primary btn-filter"><i class="fa fa-filter"></i> Filter
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					  <thead class="bg-dark text-white ">
                        <tr class="filters">
                            <th>
                                <input type="text" class="form-control" placeholder="Date" data-toggle="true" disabled>
                            </th>
                            <th>
                                <input type="text" class="form-control" placeholder="Transaction Type" data-toggle="true" disabled>
                            </th>
                            <th>
                                <input type="text" class="form-control" placeholder="Amount" disabled>
                            </th>
                            <th>
                                <input type="text" class="form-control" placeholder="View" disabled>
                            </th>
                        </tr>
					  </thead>
					  <tbody>
                        @if($cashInOuts->count()>0)
    					  	@foreach($cashInOuts as $cashInOut)
    					    <tr>
    					        <td>{{ $cashInOut->created_at->format('d-m-Y, h:i a') }}</td>
    					        <td>
                                    @if($cashInOut->transaction_id === 1 )Cash In
                                    @else Cash Out
                                    @endif
                                </td>
    					        <td>{{ $cashInOut->amount }}</td>
    					        <td>
    					      </td>
    					    </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No Payment Yet
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