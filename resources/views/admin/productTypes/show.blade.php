@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Update Product Type</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Product Type</li>
        <li class="breadcrumb-item">Update Product Type</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Update Product Type</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('productType.update', ['id'=>$productType->id]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Product Type Name</label>
                                <input type="text" class="form-control{{ $errors->has('productType') ? ' is-invalid' : '' }}" name="productType" id="productType" value="{{ $productType->productType }}">
                                @if ($errors->has('productType'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('productType') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Note</label>
                                <textarea type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" id="note">{{ $productType->note }}
                                </textarea>
                                @if ($errors->has('note'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Update Product Type</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection