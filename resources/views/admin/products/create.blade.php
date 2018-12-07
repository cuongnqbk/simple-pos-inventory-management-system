@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Add New Product</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item">Add New Product</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Add New Product</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" name="productBarcode" value="">
                            <div class="col-md-12 form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control{{ $errors->has('productName') ? ' is-invalid' : '' }}" name="productName" id="productName" value="">
                                @if ($errors->has('productName'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('productName') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Product Type</label>
                                <select class="forselect2 form-control{{ $errors->has('product_type_id') ? ' is-invalid' : '' }}" name="product_type_id" id="product_type_id">
                                    <option selected disabled>Choose an Option</option>
                                    @foreach($productTypes as $productType)
                                    <option value="{{$productType->id}}">{{$productType->productType}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product_type_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('product_type_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Sale price</label>
                                <input type="text" class="form-control{{ $errors->has('salePrice') ? ' is-invalid' : '' }}" name="salePrice" id="salePrice" value="">
                                @if ($errors->has('salePrice'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('salePrice') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input type="hidden" name="buyPrice">
                            <div class="col-md-6 form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" value=""></textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Note</label>
                                <textarea type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" id="note" value=""></textarea>
                                @if ($errors->has('note'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Add Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection