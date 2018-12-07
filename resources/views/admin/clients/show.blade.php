@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Update Client</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Client</li>
        <li class="breadcrumb-item">Update Client</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Update Client</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('client.update', ['id'=>$client->id]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ $client->name }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Contact No</label>
                                <input type="text" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" name="contact_no" id="contact_no" value="{{ $client->contact_no }}">
                                @if ($errors->has('contact_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('contact_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Business Started Since</label>
                                <input type="text" class=" form-control" name="business_started_since" id="business_started_since" value="{{ $client->business_started_since }}" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Previous Due</label>
                                <input type="text" class="form-control" name="previous_due" id="previous_due" value="{{ $client->previous_due }}" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Reference</label>
                                <input type="text" class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}" name="reference" id="reference" value="{{ $client->reference }}">
                                @if ($errors->has('reference'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reference') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address</label>
                                <textarea type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="address">{{ $client->address }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Note</label>
                                <textarea type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" id="note">{{ $client->note }}</textarea>
                                @if ($errors->has('note'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Update Client</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection