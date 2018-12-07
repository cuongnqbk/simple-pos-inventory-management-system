@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> All Supplier Expense</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Supplier</li>
        <li class="breadcrumb-item">All Supplier Expense</li>
    </ul>
</div>

<section class="m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-body">
                    <form action="{{ route('supplier.allSupplierExpenses') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Supplier Name</label>
                                <select name="supplier_id" id="supplier_id" class="forselect2 form-control">
                                    <option selected disabled>Choose...</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ 
                                        $supplier->name }}</option>
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
            <div class="card border-dark filterable">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('supplier.supplierExpense') }}" role="button">Add New Supplier Expense</a>
                    <button id="filter_button" class="btn btn-primary btn-filter"><i class="fa fa-filter"></i> Filter
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
					    <thead class="bg-dark text-white">
    					    <tr class="filters">
                                <th>
                                    <input type="text" class="form-control" placeholder="Date" data-toggle="true" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="Supplier" data-toggle="true" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="Due" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="Note" disabled>
                                </th>
    					    </tr>
					    </thead>
					    <tbody>
                        @if($supplierExpenses->count() > 0)
					  	@foreach($supplierExpenses as $supplierExpense)
        				    <tr>
                                <td>{{  $supplierExpense->created_at->format('d-m-y, h:ia') }}</td>
                                <td>{{ App\Supplier::where('id', $supplierExpense->supplier_id)->first()->name }}</td>
                                <td>{{ $supplierExpense->amount }}</td>
        				        <td> 
                                    @if($supplierExpense->note === null) 
                                        <b>No Note </b>
                                    @else 
                                        {{ $supplierExpense->note }}
                                    @endif
                                </td>
        				    </tr>
					    @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No Supplier Expense Found
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