@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> View Product</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item">View Product</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">View Product</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.update', ['id'=>$product->id]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Product ID</label>
                                <input type="text" class="form-control" name="" id="" value="{{ $product->id }}" readonly>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Product Barcode</label>
                                <input type="text" class="form-control" name="" id="" value="{{ $product->productBarcode }}" readonly>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control{{ $errors->has('productName') ? ' is-invalid' : '' }}" name="productName" id="productName" value="{{ $product->productName }}">
                                @if($errors->has('productName'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('productName') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Product Type</label>
                                <select class="forselect2 form-control{{ $errors->has('product_type_id') ? ' is-invalid' : '' }}" name="product_type_id" id="product_type_id">
                                    @foreach($productTypes as $productType)
                                    <option value="{{$productType->id}}"
                                        @if($product->productType->id == $productType->id)
                                            selected
                                        @endif
                                    >{{$productType->productType}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product_type_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('product_type_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description">{{ $product->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Note</label>
                                <textarea type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" id="note">{{ $product->note }}</textarea>
                                @if ($errors->has('note'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Stock Quantity</label>
                                <input type="text" class="form-control{{ $errors->has('stockQuantity') ? ' is-invalid' : '' }}" name="stockQuantity" id="stockQuantity" value="{{ $product->stockQuantity }}" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Average Buy Price</label>
                                <input type="text" class="form-control{{ $errors->has('buyPrice') ? ' is-invalid' : '' }}" name="buyPrice" id="buyPrice" value="{{ $product->buyPrice }}" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Sale price</label>
                                <input type="text" class="form-control{{ $errors->has('salePrice') ? ' is-invalid' : '' }}" name="salePrice" id="salePrice" value="{{ $product->salePrice }}">
                                @if ($errors->has('salePrice'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('salePrice') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Update Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@if(App\Stock::all()->count() > 0)
<section class="allExpense-part m-t-25 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h5 class="text-white">Product Quantity in Shops</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Shop Name</th>
                                <th>Total Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proShops as $proShop)
                                <tr>
                                    <td>
                                        {{ 
                                            App\Shop::where('id', $proShop->shop_id)->first()->name
                                        }}
                                    </td>
                                    <td>{{ $proShop->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection