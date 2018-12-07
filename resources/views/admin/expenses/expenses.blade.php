@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> ALL EXPENSE</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Expense</li>
        <li class="breadcrumb-item">All Expense</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('expense.create') }}" role="button">Add Expense</a>
                    <a class="btn btn-primary" href="{{ route('expenseField.create') }}" role="button">Add Expense Field</a>
                </div>
                <div class="card-body">
                	<form action="{{ route('expenses') }}" method="post">
                		{{ csrf_field() }}
	                    <div class="row">
	                    	<div class="col-md-4 form-group">
								<label>Expense Field</label>
								<select name="expense_field_id" id="expense_field_id" class="form-control">
									<option selected disabled>Choose...</option>
									@foreach($expense_fields as $expense_field)
        							<option value="{{ $expense_field->id }}">{{ $expense_field->expense_field }}</option>
        							@endforeach
								</select>
							</div>
	                    	<div class="col-md-4 form-group">
								<label>Date From</label>
								<input type="text" id="startDate" class="form-control datepicker" name="expense_date_from" value="{{ old('') }}"/>
								@if ($errors->has('expense_date_from'))
	                                <span class="invalid-feedback">
	                                    <strong>{{ $errors->first('expense_date_from') }}</strong>
	                                </span>
	                            @endif
							</div>
	                    	<div class="col-md-4 form-group">
								<label>Date To</label>
								<input class="form-control datepicker" name="expense_date_to" value="{{ old('') }}">

								@if ($errors->has('expense_date_to'))
	                                <span class="invalid-feedback">
	                                    <strong>{{ $errors->first('expense_date_to') }}</strong>
	                                </span>
	                            @endif
							</div>
							<div class="col text-right">
								<button class="btn btn-primary" name="dateRangeSubmit">Search</button>
							</div>
	                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row p-t-50">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h4 class="text-white">View All Expenses<span class="float-right">Total: {{ $expenses->sum('amount') }} </span> </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					  <thead class="bg-dark text-white">
					    <tr>
					      <th scope="col">Date</th>
					      <th scope="col">Expense Field</th>
					      <th scope="col">Amount</th>
					      <th scope="col">View</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@if($expenses->count() > 0)
					    	@foreach($expenses as $expense)
					    	<tr>
						      <td>{{ $expense->created_at->format('d-m-Y, h:i a') }}</td>
						      <td>{{ $expense->expenseField->expense_field }}</td>
						      <td>{{ $expense->amount }}</td>
						      <td>
						      	<a href="{{ route('expense.show', ['id'=>$expense->id]) }}" class="btn btn-dark btn-sm">
						      		<i class="fas fa-info-circle"></i>
						      	</a>
						      </td>
					    	</tr>
					    	@endforeach
					    @else
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No Expense Found
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