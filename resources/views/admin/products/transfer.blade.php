@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Transfer Product</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item">Transfer Product</li>
    </ul>
</div>

<section class="transfer m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Transfer Product</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.storeTransfer') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group">
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
                                <label>Transfer From Shop</label>
                                <select class="form-control{{ $errors->has('shop_from_id') ? ' is-invalid' : '' }}" name="shop_from_id" id="shop_from_id" disabled>
                                    <option selected disabled>Choose an Option</option>
                                    @foreach($shops as $shop)
                                    <option value="{{$shop->id}}">{{$shop->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('shop_from_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('shop_from_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Stock Quantity</label>
                                <input type="text" class="form-control{{ $errors->has('stockQuantityFrom') ? ' is-invalid' : '' }}" name="stockQuantityFrom" id="stockQuantityFrom" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Transfer To Shop</label>
                                <select class="form-control{{ $errors->has('shop_to_id') ? ' is-invalid' : '' }}" name="shop_to_id" id="shop_to_id" disabled>
                                    <option selected disabled>Choose an Option</option>
                                    @foreach($shops as $shop)
                                    <option value="{{$shop->id}}">{{$shop->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('shop_to_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('shop_to_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Stock Quantity</label>
                                <input type="text" class="form-control{{ $errors->has('stockQuantityTo') ? ' is-invalid' : '' }}" name="stockQuantityTo" id="stockQuantityTo" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" id="quantity">
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Reference</label>
                                 <input type="text" class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}" name="reference" id="reference">
                                @if ($errors->has('reference'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reference') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Note</label>
                                <textarea type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" id="note" value=""></textarea>
                                @if ($errors->has('note'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Transfer Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection