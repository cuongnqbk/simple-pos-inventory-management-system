@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> All Product Types</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Product Types</li>
        <li class="breadcrumb-item">All Product Types</li>
    </ul>
</div>

<section class="m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('productType.create') }}" role="button">Add New Product Type</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
					    <thead class="bg-dark text-white">
    					    <tr>
    					        <th scope="col">ID</th>
                                <th scope="col">Product Type Name</th>
                                <th scope="col">View</th>
    					    </tr>
					    </thead>
					    <tbody>
                        @if($productTypes->count() > 0)
					  	@foreach($productTypes as $productType)
        				    <tr>
        				        <td>{{ $productType->id }}</td>
                                <td>{{ $productType->productType }}</td>
                                <td>
                                    <a href="{{ route('productType.show', ['id'=>$productType->id]) }}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
        				    </tr>
					    @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No Client Found
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