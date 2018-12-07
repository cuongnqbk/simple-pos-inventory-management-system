@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Add Product to Stock</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item">Add Product to Stock</li>
    </ul>
</div>

<section class="addToStock m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Add Product to Stock</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('stock.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Product Name</label>
                                <select class="forselect2 form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" name="product_id" id="product_id">
                                    <option selected disabled>Choose an Option</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->productName}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('product_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Shop</label>
                                <select class="form-control{{ $errors->has('shop_id') ? ' is-invalid' : '' }}" name="shop_id" id="shop_id">
                                    <option selected disabled>Choose an Option</option>
                                    @foreach($shops as $shop)
                                    <option value="{{$shop->id}}">{{$shop->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('shop_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('shop_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" id="quantity" value="" readonly="readonly">
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Unit Cost</label>
                                <input type="text" class="form-control" name="unit_cost" id="unit_cost">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Total Cost</label>
                                <input type="text" class="form-control{{ $errors->has('total_cost') ? ' is-invalid' : '' }}" name="total_cost" id="total_cost" value="" readonly="readonly">
                                @if ($errors->has('total_cost'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('total_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
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
                            <div class="col-md-4 form-group">
                                <label>Previous Quantity</label>
                                <input type="text" class="form-control" name="previous_quantity" id="previous_quantity" value="" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>New Quantity</label>
                                <input type="text" class="form-control" name="new_quantity" id="new_quantity" value="" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Buy Price</label>
                                <input type="text" class="form-control" name="buyPrice" id="buyPrice" value="" readonly>
                            </div>
                            <input type="hidden" name="previous_buyPrice" id="previous_buyPrice">
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Add Product to Stock</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection