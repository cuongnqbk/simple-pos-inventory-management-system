@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-amazon-pay"></i> VIEW PAYMENT</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Payments</li>
        <li class="breadcrumb-item">View Payment</li>
    </ul>
</div>
<section class="receivePayment m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h2 class="text-white">View Payment</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('receivePayment.update', ['id'=>$receivePayment->id]) }}" method="post">
                        @csrf
                        <div class="row">
    						<div class="col-md-6 form-group">
    						  <label>Resident</label>
    						  <input type="text" class="form-control" id="resident_id" name="resident_id" value="{{ $receivePayment->client->name }}" readonly>
    						</div>
                            <div class="col-md-6 form-group">
                                <label>Paid Amount</label>
                                <input type="text" class="form-control" id="paid_amount" name="paid_amount" value="{{ $receivePayment->paid_amount }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>New Due</label>
                                <input type="text" class="form-control" id="due" name="due" value="{{ $receivePayment->due }}"  readonly>
                            </div>
    						<div class="col-md-6 form-group">
    							<label>Received By</label>
    							<input type="text" class="form-control" id="received_by" name="received_by" value="{{ $receivePayment->received_by }}"  readonly>
    						</div>
    						<div class="col-md-12 form-group">
    							<label>Note</label>
    							<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note">{{ $receivePayment->note }}</textarea>
    						</div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Update Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection