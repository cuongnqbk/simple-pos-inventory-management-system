@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Supplier Expense</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Supplier</li>
        <li class="breadcrumb-item">Supplier Expense</li>
    </ul>
</div>

<section class="supplierExpense m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Add Supplier Expense</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('supplier.storeSupplierExpense') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Supplier</label>
                                <select class="forselect2 form-control{{ $errors->has('supplier_id') ? ' is-invalid' : '' }}" name="supplier_id" id="supplier_id">
                                    <option selected diabled>Choose an Option</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('supplier_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('supplier_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Previous Due</label>
                                <input type="text" class="form-control{{ $errors->has('previous_due') ? ' is-invalid' : '' }}" name="previous_due" id="previous_due" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" id="amount" readonly="readonly">
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Due</label>
                                <input type="text" class="form-control{{ $errors->has('due') ? ' is-invalid' : '' }}" name="due" id="due" readonly>
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
                                <button class="btn btn-primary" type="submit">Add Supplier Expense</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection