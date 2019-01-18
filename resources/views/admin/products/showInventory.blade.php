@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Show Inventory</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Products</li>
        <li class="breadcrumb-item">Show Inventory</li>
    </ul>
</div>

<section class="m-t-80 m-b-50">
    <div class="row m-b-25">
        <div class="col-md-12">
            <h4><b>Total Product:</b> {{ $productsCount }}, Total Buy Price:</b> {{ $productsBuyPrice }},  Total Sale Price:</b> {{ $productsSalePrice }}  </h4>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card border-dark filterable">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('product.create') }}" role="button">Add New Product</a>
                    <a class="btn btn-primary" href="{{ route('stock.create') }}" role="button">Add Product to Stock</a>
                    <a class="btn btn-primary" href="{{ route('product.transfer') }}" role="button">Transfer Product</a>
                    <button id="filter_button" class="btn btn-primary btn-filter"><i class="fa fa-filter"></i> Filter
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
					    <thead class="bg-dark text-white">
    					    <tr class="filters">
                                <th>
                                    <input type="text" class="form-control" placeholder="Barcode" data-toggle="true" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="Product" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="Type" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="Buy Price" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="Sale Price" disabled>
                                </th>
                                <th>
                                    <input type="text" class="form-control" placeholder="Stock Quantity" disabled>
                                </th>
                                <th>
                                    <span>View</span>
                                </th>
    					    </tr>
					    </thead>
					    <tbody>
                        @if($products->count() > 0)
					  	@foreach($products as $product)
        				    <tr>
                                <td>{{ $product->productBarcode }}</td>
        				        <td>{{ $product->productName }}</td>
                                <td>{{ $product->productType->productType }}</td>
                                <td>{{ $product->buyPrice }}</td>
                                <td>{{ $product->salePrice }}</td>
                                <td>{{ $product->stockQuantity }}</td>
                                <td>
                                    <a href="{{ route('product.show', ['id'=>$product->id]) }}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
        				    </tr>
					    @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No Product Found
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