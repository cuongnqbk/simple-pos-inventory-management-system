@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Barcode</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Barcode</li>
    </ul>
</div>

<section class="m-t-80 m-b-25">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Create Barcode</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('barcode.store') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Product Name</label>
                                <select name="product_id" id="product_id" class="forselect2 form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}">
                                    <option selected disabled>Choose a Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->productName }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('product_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" id="quantity" value="1">
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <button class="btn btn-primary btn-sm m-t-30" type="submit" id="printSubmit">Add Product</button>
                                <a class="btn btn-danger btn-sm m-t-30" type="submit" href="{{ route('barcode.destroyPrintBarcode') }}">Destroy Cart</a>
                            </div>
                        </div>
                    </form>

                    <div class="row m-t-25">
                        <div class="col-md-12">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qunatity</th>
                                    </tr>
                                </thead>
                                <tbody id="printTable">
                                    @foreach(Cart::instance('barcode')->content() as $cart)
                                        <tr>
                                            <td id="name{{ $cart->id }}">{{ $cart->name }}</td>
                                            <td id="quantity{{ $cart->id }}">{{ $cart->qty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row m-t-15">
                        <div class="col-md-12">
                            <form action="{{ route('barcode.printBarcode') }}" method="post">
                                @csrf
                                <button class="btn btn-primary" type="submit" id="">Print</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection