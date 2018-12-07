@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Add Debit Note</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Debit Note</li>
        <li class="breadcrumb-item">Add Debit Note</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Add Debit Note</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('debitNote.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Date **</label>
                                <input type="text" class="datepicker form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" id="date" value="">
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Client **</label>
                                <select name="client_id" id="client_id" class="form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}">
                                    <option selected disabled>Choose an Option</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('client_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('client_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Amount **</label>
                                <input type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" id="amount" value="">
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Details</label>
                                <textarea type="text" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" id="details" value=""></textarea>
                                @if ($errors->has('details'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Note</label>
                                <textarea type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" id="note" value=""></textarea>
                                @if ($errors->has('note'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Add Debit Note</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection