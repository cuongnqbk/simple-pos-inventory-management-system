@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> All Suppliers</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Suppliers</li>
        <li class="breadcrumb-item">All Suppliers</li>
    </ul>
</div>

<section class="m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark filterable">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('supplier.create') }}" role="button">Add New Supplier</a>
                    <button id="filter_button" class="btn btn-primary btn-filter"><i class="fa fa-filter"></i> Filter
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
					    <thead class="bg-dark text-white">
    					    <tr class="filters">
                                <th>
                                    <input type="text" class="form-control" placeholder="Name" data-toggle="true" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="Contact No." data-toggle="true" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="Previous Due" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="View" disabled>
                                </th>
    					    </tr>
					    </thead>
					    <tbody>
                        @if($suppliers->count() > 0)
					  	@foreach($suppliers as $supplier)
        				    <tr>
        				        <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->contact_no }}</td>
        				        <td>{{ $supplier->previous_due }}</td>
                                <td>
                                    <a href="{{ route('supplier.show', ['id'=>$supplier->id]) }}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
        				    </tr>
					    @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No supplier Found
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