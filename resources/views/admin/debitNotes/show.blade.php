@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> View Debit Note</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Debit Note</li>
        <li class="breadcrumb-item">View Debit Note</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">View Debit Note</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Date **</label>
                            <input type="text" class=" form-control" name="date" id="date" value="{{ $debitNote->date }}" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Client **</label>
                            <input type="text" class=" form-control" name="client_id" id="client_id" value="{{ $debitNote->client->name }}" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Amount **</label>
                            <input type="text" class="form-control" name="amount" id="amount" value="{{ $debitNote->amount }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Details</label>
                            <textarea type="text" class="form-control" name="details" id="details" readonly>{{ $debitNote->details }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Note</label>
                            <textarea type="text" class="form-control" name="note" id="note" readonly>{{ $debitNote->note }}</textarea>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-danger" onclick="window.history.back()">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection