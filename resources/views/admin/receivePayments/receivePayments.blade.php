@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-amazon-pay"></i> ALL RECEIVED PAYMENT</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Payments</li>
        <li class="breadcrumb-item">All Received Payment</li>
    </ul>
</div>

<section class="allExpense-part m-t-80">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('receivePayment.create') }}" role="button">
                    	Received Payment
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
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h4 class="text-white">All Received Payments <span class="float-right">Total: {{ $receivePayments->sum('paid_amount') }} </span> </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					  <thead class="bg-dark text-white">
					    <tr>
					      <th scope="col">Date</th>
					      <th scope="col">Client</th>
					      <th scope="col">Amount</th>
					      <th scope="col">View</th>
					    </tr>
					  </thead>
					  <tbody>
                        @if($receivePayments->count()>0)
    					  	@foreach($receivePayments as $receivePayment)
    					    <tr>
    					        <td>{{ $receivePayment->created_at->format('d-m-Y, h:i a') }}</td>
    					        <td>{{ $receivePayment->client->name}}</td>
    					        <td>{{ $receivePayment->paid_amount }}</td>
    					        <td>
    					      	    <a href="{{ route('receivePayment.show', ['id'=>$receivePayment->id]) }}" class="btn btn-primary btn-sm">
    					      		<i class="fas fa-info-circle"></i>
    					      	</a>
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