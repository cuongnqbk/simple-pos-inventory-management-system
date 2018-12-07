@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> All Supplier Bill</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Supplier</li>
        <li class="breadcrumb-item">All Supplier Bill</li>
    </ul>
</div>

<section class="m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark filterable">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('supplier.supplierBill') }}" role="button">Add New Supplier Bill</a>
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
                                    <input type="text" class="form-control" placeholder="Details" disabled>
                                </th>
    					    </tr>
					    </thead>
					    <tbody>
                        @if($supplierBills->count() > 0)
					  	@foreach($supplierBills as $supplierBill)
        				    <tr>
                                <td>{{  $supplierBill->created_at->format('d-m-y, h:ia') }}</td>
                                <td>{{ App\Supplier::where('id', $supplierBill->supplier_id)->first()->name }}</td>
                                <td>{{ $supplierBill->amount }}</td>
        				        <td> 
                                    @if($supplierBill->details === null) 
                                        <b>No Details </b>
                                    @else 
                                        {{ $supplierBill->details }}
                                    @endif
                                </td>
        				    </tr>
					    @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No Supplier Bill Found
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