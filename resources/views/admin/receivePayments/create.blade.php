@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-amazon-pay"></i> RECEIVED PAYMENT</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Payments</li>
        <li class="breadcrumb-item">Received Payment</li>
    </ul>
</div>

<section class="receivePayment m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h2 class="text-white">Received Payments</h2>
                </div>
                <div class="card-body">
                	<form action="{{ route('receivePayment.store') }}" method="post">
                		{{ csrf_field() }}
	                    <div class="row">
							<div class="col-md-6 form-group">
							  <label>Select Client**</label>
							  <select class="form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}" id="client_id" name="client_id">
							    <option selected disabled>Choose...</option>
							    @foreach($clients as $client)
							    <option value="{{ $client->id }}">{{ $client->name }}</option>
							    @endforeach
							    </select>
							    @if ($errors->has('client_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('client_id') }}</strong>
                                </span>
                            @endif
							</div>
							<div class="col-md-6 form-group">
								<label>Previous Due</label>
								<input type="text" class="form-control" id="previous_due" name="previous_due" readonly>
							</div>
	                        <div class="col-md-6 form-group">
	                            <label>Paid Amount**</label>
	                            <input type="text" class="form-control{{ $errors->has('paid_amount') ? ' is-invalid' : '' }}" id="paid_amount" name="paid_amount">
	                            @if ($errors->has('paid_amount'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('paid_amount') }}</strong>
                                </span>
                            @endif
	                        </div>
							<div class="col-md-6 form-group">
								<label>New Due</label>
								<input type="text" class="form-control" id="due" name="due" readonly>
							</div>
							<div class="col-md-12 form-group">
								<label>Note</label>
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note"></textarea>
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