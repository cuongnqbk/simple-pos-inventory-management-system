@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> VIEW EXPENSE</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Expense</li>
        <li class="breadcrumb-item">View Expense</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">View Expense</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Expense Field</label>
                            <input type="text" class="form-control" value="{{ $expense->expenseField->expense_field }}" disabled>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount" value="{{ $expense->amount }}" disabled>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Added By</label>
                            <input type="text" class="form-control" name="added_by" id="added_by" value="{{ $expense->added_by }}" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Details</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="details" disabled>{{ $expense->details }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Note</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note" disabled>{{ $expense->note }} </textarea>
                        </div>
                        <div class="col text-right">
                            <!-- <button class="btn btn-dark" type="submit">Update Expense</button> -->
                            <button class="btn btn-danger" onclick="window.history.back()">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection