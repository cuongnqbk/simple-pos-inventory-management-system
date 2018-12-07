@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> VIEW EXPENSE FIELD</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Expense</li>
        <li class="breadcrumb-item"><a href="{{ route('expenseFields') }}">All Expense Field</a></li>
        <li class="breadcrumb-item">View Expense Field</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h4 class="text-white">View Expense Field</h4>
                </div>
                <div class="card-body">
                	<form action="{{ route('expenseField.update', ['id'=>$expenseField->id])}}" method="post">
                		{{ csrf_field() }}
                    	<div class="row">
							<div class="col form-group">
								<label>Expense Field</label>
								<input type="text" class="form-control{{ $errors->has('expense_field') ? ' is-invalid' : '' }}" name="expense_field" id="expense_field" value="{{ $expenseField->expense_field }}">
                                @if ($errors->has('expense_field'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('expense_field') }}</strong>
                                </span>
                                @endif
							</div>
						</div>
						<div class="row">
							<div class="col text-right">
								<button class="btn btn-primary" type="submit">Update Expense Field</button>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection