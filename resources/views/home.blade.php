@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-6">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Sale</h4>
              <p><b>{{ 
                \App\Sale::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('totalBill') }}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Profit</h4>
              <p><b>{{ \App\Sale::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('profit') }}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>SUPPLIER Payment</h4>
              <p><b>{{ App\SupplierExpense::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount') }}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h4>Expense</h4>
              <p><b>{{ \App\Expense::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount') }}</b></p>
            </div>
          </div>
        </div>
      </div>


  {{-- <div class="row">
    <div class="col-md-6 col-lg-6">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Profit</h4>
          <p><b>{{ \App\Sale::whereDate('created_at', date('y-m-d'))->sum('profit') }}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Payment</h4>
          <p><b>{{ App\SupplierExpense::whereDate('created_at', date('y-m-d'))->sum('amount') }}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Sale</h4>
          <p><b>{{ \App\Sale::whereDate('created_at', date('y-m-d'))->sum('subTotal') + \App\Sale::whereDate('created_at', date('y-m-d'))->sum('additionalCost') -+- \App\Sale::whereDate('created_at', date('y-m-d'))->sum('discount')}}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
        <div class="info">
          <h4>Expense</h4>
          <p><b>{{ \App\Expense::whereDate('created_at', date('y-m-d'))->sum('amount') }}</b></p>
        </div>
      </div>
    </div>
  </div> --}}
</div>
@endsection
