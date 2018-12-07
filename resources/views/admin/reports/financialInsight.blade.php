@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> FINANCIAL INSIGHT</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Report</li>
        <li class="breadcrumb-item">Financial Insight</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                </div>
                <div class="card-body">
                	<form action="{{ route('financialInsight') }}" method="post">
                		{{ csrf_field() }}
	                    <div class="row">
	                    	<div class="col-md-6 form-group">
								<label>Date From</label>
								<input type="text" id="startDate" class="form-control datepicker" name="date_from" value="{{ old('') }}"/>
								@if ($errors->has('date_from'))
	                                <span class="invalid-feedback">
	                                    <strong>{{ $errors->first('date_from') }}</strong>
	                                </span>
	                            @endif
							</div>
	                    	<div class="col-md-6 form-group">
								<label>Date To</label>
								<input class="form-control datepicker" name="date_to" value="{{ old('') }}">
								@if ($errors->has('date_to'))
	                                <span class="invalid-feedback">
	                                    <strong>{{ $errors->first('date_to') }}</strong>
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
                    <h4 class="text-white">Capital & Assets</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					  	<tbody>
					    	<tr>
						      	<td>Cash In</td>
						      	<td>{{ $cashIn }}</td>
						  	</tr>
					    	<tr>
						      	<td>Cash Out</td>
						      	<td>{{ $cashOut }}</td>
						  	</tr>
					    	<tr>
						      	<td>Total Investment</td>
						      	<td>{{ $cashIn - $cashOut }}</td>
						  	</tr>
					    	<tr>
						      	<td>Supplier Payment</td>
						      	<td>{{ $supplierExpense }}</td>
						  	</tr>
						  	<tr>
						      	<td>Total Cash</td>
						      	<td>{{ $cashIn - $cashOut -$supplierExpense }}</td>
						  	</tr>
					    	<tr>
						      	<td>Stock Buy Price</td>
						      	<td>{{ $productsBuyPrice }}</td>
						  	</tr>
					    	<tr>
						      	<td>Stock Sale Price</td>
						      	<td>{{ $productsSalePrice }}</td>
						  	</tr>
					    	<tr>
						      	<td>Account Receivable</td>
						      	<td>{{ $accountReceivable }}</td>
						  	</tr>
					  	</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-t-50">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h4 class="text-white">Sale Profit</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					  	<tbody>
					    	<tr>
						      	<td>Total Sale</td>
						      	<td>{{ $totalSale }}</td>
						  	</tr>
					    	<tr>
						      	<td>Sale Profit</td>
						      	<td>{{ $totalProfit }}</td>
						  	</tr>
					    	<tr>
						      	<td>Total Expense</td>
						      	<td>{{ $totalExpense }}</td>
						  	</tr>
					    	<tr>
						      	<td>Net Profit</td>
						      	<td>{{ $totalProfit - $totalExpense }}</td>
						  	</tr>
					  	</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-t-50">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h4 class="text-white">Liabilities</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					  	<tbody>
					    	<tr>
						      	<td>Supplier Due/Account Payable</td>
						      	<td>{{ $supplierDue }}</td>
						  	</tr>
					    	<tr>
						      	<td>Other due</td>
						      	<td>{{ $totalProfit - $totalExpense }}</td>
						  	</tr>
					  	</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection