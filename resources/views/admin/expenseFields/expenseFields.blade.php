@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> ALL EXPENSE FIELDS</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Expense</li>
        <li class="breadcrumb-item">All Expense Fields</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('expenseField.create') }}" role="button">Add Expense Field</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
					  <thead class="bg-dark text-white">
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">Expense Field</th>
					      <th scope="col">View</th>
					    </tr>
					  </thead>
					  <tbody>
                        @if($expenseFields->count() > 0)
					  	@foreach($expenseFields as $expenseField)
					    <tr>
					      <td>{{ $expenseField->id }}</td>
					      <td>{{ $expenseField->expense_field }}</td>
					      <td>
					      	<a href="{{ route('expenseField.show', ['id'=>$expenseField->id]) }}" class="btn btn-primary btn-sm">
					      		<i class="fas fa-info-circle"></i>
					      	</a>
					      </td>
					    </tr>
					    @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No Expense Field Yet
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