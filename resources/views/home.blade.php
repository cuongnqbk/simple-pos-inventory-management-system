@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-6 col-lg-6">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Profit</h4>
              <p><b>{{ \App\Sale::whereMonth('created_at', date('m'))->sum('profit') }}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Payment</h4>
              <p><b>{{ App\SupplierExpense::whereMonth('created_at', date('m'))->sum('amount') }}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Sale</h4>
              <p><b>{{ \App\Sale::whereMonth('created_at', date('m'))->sum('subTotal') + \App\Sale::whereMonth('created_at', date('m'))->sum('additionalCost') -+- \App\Sale::whereMonth('created_at', date('m'))->sum('discount')}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h4>Expense</h4>
              <p><b>{{ \App\Expense::whereMonth('created_at', date('m'))->sum('amount') }}</b></p>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
