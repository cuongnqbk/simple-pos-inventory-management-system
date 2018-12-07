@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-amazon-pay"></i> CASH IN OUT PAYMENT</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Cash</li>
        <li class="breadcrumb-item">Add New Cash In Out</li>
    </ul>
</div>

<section class="receivePayment m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h2 class="text-white">Add New Cash In Out</h2>
                </div>
                <div class="card-body">
                	<form action="{{ route('cashInOut.store') }}" method="post">
                		{{ csrf_field() }}
	                    <div class="row">
							<div class="col-md-6 form-group">
							  <label>Transaction Type</label>
							  <select class="form-control{{ $errors->has('transaction_id') ? ' is-invalid' : '' }}" id="transaction_id" name="transaction_id">
								    <option value="0" selected disabled>Choose...</option>
								    <option value="1">Cash In</option>
								    <option value="2">Cash Out</option>
							    </select>
							    @if ($errors->has('transaction_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('transaction_id') }}</strong>
                                </span>
                            	@endif
							</div>
							<div class="col-md-6 form-group">
								<label>Amount</label>
								<input type="text" class="form-control" id="amount" name="amount">
								@if ($errors->has('amount'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                                @endif
							</div>
							<div class="col-md-12 form-group">
								<label>Details</label>
								<textarea class="form-control" id="details" rows="3" name="details"></textarea>
							</div>
	                        <div class="col text-right">
	                            <button class="btn btn-primary" type="submit">Submit</button>
	                        </div>
	                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection