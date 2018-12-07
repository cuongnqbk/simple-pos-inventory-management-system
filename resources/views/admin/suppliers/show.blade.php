@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Update Supplier</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Suppliers</li>
        <li class="breadcrumb-item">Update Supplier</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Update Supplier</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('supplier.update', ['id'=>$supplier->id]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ $supplier->name }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Contact No</label>
                                <input type="text" class="form-control{{ $errors->has('contact_no') ? ' is-invalid' : '' }}" name="contact_no" id="contact_no" value="{{ $supplier->contact_no }}">
                                @if ($errors->has('contact_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('contact_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Previous Due</label>
                                <input type="text" class="form-control" name="previous_due" id="previous_due" value="{{ $supplier->previous_due }}" readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Details</label>
                                <textarea type="text" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" id="details">{{ $supplier->details }}</textarea>
                                @if ($errors->has('details'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Update Supplier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection