@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> ADD EXPENSE</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Expense</li>
        <li class="breadcrumb-item">Add Expense</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h2 class="text-white">Add Expense</h2>
                </div>
                <div class="card-body">
                	<form action="{{ route('expense.store') }}" method="post">
                		{{ csrf_field() }}
	                    <div class="row">
							<div class="col-md-6 form-group">
								<label>Expense Field **</label>
								<select name="expense_field_id" id="expense_field_id" class="form-control{{ $errors->has('expense_field_id') ? ' is-invalid' : '' }}">
									<option selected disabled>Choose...</option>
									@foreach($expense_fields as $expense_field)
        							<option value="{{ $expense_field->id }}">{{ $expense_field->expense_field }}</option>
        							@endforeach
								</select>
								@if ($errors->has('expense_field_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('expense_field_id') }}</strong>
                                </span>
                            @endif
							</div>
							<div class="col-md-6 form-group">
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
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="details"></textarea>
							</div>
							<div class="col-md-6 form-group">
								<label>Note</label>
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note"></textarea>
							</div>
							<div class="col text-right">
								<button class="btn btn-primary" type="submit">Add Expense</button>
							</div>
	                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection