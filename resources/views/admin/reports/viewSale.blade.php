@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> View Sale</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">View Sale</li>
    </ul>
</div>

<section class="m-b-50">
	<div class="row m-b-25">
		<div class="col-md-12">
			<div class="card border-dark">
				<div class="card-header text-right bg-dark">
                </div>
                <div class="card-body">
                	<div class="row">
                		<div class="col-md-6">
                			<div class="form-group">
                				<label for="">Sale ID</label>
                				<input type="text" class="form-control" name="" value="{{ $sale->id }}" readonly>
                			</div>
                		</div>
                		<div class="col-md-6">
                			<div class="form-group">
                				<label for="">Date</label>
                				<input type="text" class="form-control" name="" value="{{ $sale->created_at->format('d:m:y, h:ia') }}" readonly>
                			</div>
                		</div>
                	</div>
				</div>
			</div>
		</div>
	</div>
    
    
</section>

<section class="m-b-50">
	<div class="row">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
            		<h4 class="text-white">Sale Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					  <thead class="bg-dark text-white">
					    <tr>
					      <th scope="col">Product</th>
					      <th scope="col">Quantity</th>
					      <th scope="col">Rate</th>
					      <th scope="col">Total</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@if(Auth::user()->admin)
					    	@foreach($saleDetails as $saleDetail)
					    	<tr>
						      	<td>{{ \App\Product::where('id', $saleDetail->product_id)->first()->productName }}</td>
						      	<td>{{ $saleDetail->quantity }}</td>
						      	<td>{{ $saleDetail->price }}</td>
						     	<td>{{ $saleDetail->subTotal }}</td>
					    	</tr>
					    	@endforeach
					    @else
					    	@foreach($saleDetails->where('shop_id', Auth::user()->shop_id) as $saleDetail)
						    	<tr>
							      	<td>{{ \App\Product::where('id', $saleDetail->product_id)->first()->productName }}</td>
							      	<td>{{ $saleDetail->quantity }}</td>
							      	<td>{{ $saleDetail->price }}</td>
							     	<td>{{ $saleDetail->subTotal }}</td>
						    	</tr>
					    	@endforeach	
					    @endif				    	
					  </tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="m-b-50">
	<div class="row m-t-25">
		<div class="col-md-12">
			<div class="card border-dark">
				<div class="card-header text-right bg-dark">
                </div>
                <div class="card-body">
                	<div class="row">
                		<div class="col-md-4">
                			<div class="form-group">
                				<label for="">Subtotal</label>
                				<input type="text" class="form-control" name="" value="{{ $sale->subTotal }}" readonly>
                			</div>
                		</div>
                		<div class="col-md-4">
                			<div class="form-group">
                				<label for="">Additional cost</label>
                				<input type="text" class="form-control" name="" value="{{ $sale->additionalCost}}" readonly>
                			</div>
                		</div>
                		<div class="col-md-4">
                			<div class="form-group">
                				<label for="">Discount</label>
                				<input type="text" class="form-control" name="" value="{{ $sale->discount}}" readonly>
                			</div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="col-md-3">
                			<div class="form-group">
                				<label for="">Total Bill</label>
                				<input type="text" class="form-control" name="" value="{{ $sale->totalBill }}" readonly>
                			</div>
                		</div>
                		<div class="col-md-3">
                			<div class="form-group">
                				<label for="">Grand total</label>
                				<input type="text" class="form-control" name="" value="{{ $sale->totalBill}}" readonly>
                			</div>
                		</div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Paid amount</label>
                                <input type="text" class="form-control" name="" value="{{ $sale->paidAmount }}" readonly>
                            </div>
                        </div>
                		<div class="col-md-3">
                			<div class="form-group">
                				<label for="">Profit</label>
                				<input type="text" class="form-control" name="" value="{{ $sale->profit }}" readonly>
                			</div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="col-md-12">
                			<button class="btn btn-danger float-right" onclick="window.history.back()">Back</button>
                		</div>
                	</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection