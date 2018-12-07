@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> View Return</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">View Return</li>
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
                				<label for="">Return ID</label>
                				<input type="text" class="form-control" name="" value="{{ $returnProduct->id }}" readonly>
                			</div>
                		</div>
                		<div class="col-md-6">
                			<div class="form-group">
                				<label for="">Date</label>
                				<input type="text" class="form-control" name="" value="{{ $returnProduct->created_at->format('d:m:y, h:ia') }}" readonly>
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
                    <h4 class="text-white">Returned Product</h4>
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
                            @foreach($returnProductDetails as $returnProductDetail)
                            <tr>
                                <td>{{ \App\Product::where('id', $returnProductDetail->product_id)->first()->productName }}</td>
                                <td>{{ $returnProductDetail->quantity }}</td>
                                <td>{{ $returnProductDetail->price }}</td>
                                <td>{{ $returnProductDetail->subTotal }}</td>
                            </tr>
                            @endforeach
                        @else
                            @foreach($returnProductDetails->where('shop_id', Auth::user()->shop_id) as $returnProductDetail)
                                <tr>
                                    <td>{{ \App\Product::where('id', $returnProductDetail->product_id)->first()->productName }}</td>
                                    <td>{{ $returnProductDetail->quantity }}</td>
                                    <td>{{ $returnProductDetail->price }}</td>
                                    <td>{{ $returnProductDetail->subTotal }}</td>
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
@if($returnSaleDetails->count() > 0)
<section class="m-b-50">
	<div class="row">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
            		<h4 class="text-white">Sale Product</h4>
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
					    	@foreach($returnSaleDetails as $returnSaleDetail)
					    	<tr>
						      	<td>{{ \App\Product::where('id', $returnSaleDetail->product_id)->first()->productName }}</td>
						      	<td>{{ $returnSaleDetail->quantity }}</td>
						      	<td>{{ $returnSaleDetail->price }}</td>
						     	<td>{{ $returnSaleDetail->subTotal }}</td>
					    	</tr>
					    	@endforeach
					    @else
					    	@foreach($returnSaleDetails->where('shop_id', Auth::user()->shop_id) as $returnSaleDetail)
						    	<tr>
							      	<td>{{ \App\Product::where('id', $returnSaleDetail->product_id)->first()->productName }}</td>
							      	<td>{{ $returnSaleDetail->quantity }}</td>
							      	<td>{{ $returnSaleDetail->price }}</td>
							     	<td>{{ $returnSaleDetail->subTotal }}</td>
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
@endif
<section class="m-b-50">
	<div class="row m-t-25">
		<div class="col-md-12">
			<div class="card border-dark">
				<div class="card-header text-right bg-dark">
                </div>
                <div class="card-body">
                	<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Total Returned Items</label>
                                <input type="text" class="form-control" name="" value="{{ \App\ReturnProductDetail::where('return_id', $returnProduct->id)->sum('quantity') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Returned Total</label>
                                <input type="text" class="form-control" name="" value="{{ \App\ReturnProductDetail::where('return_id', $returnProduct->id)->sum('subTotal') }}" readonly>
                            </div>
                        </div>
                        @if($returnSaleDetails->count() > 0)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Total Sale Items</label>
                                <input type="text" class="form-control" name="" value="{{ \App\returnSaleDetail::where('return_id', $returnProduct->id)->sum('quantity') }}" readonly>
                            </div>
                        </div>
                		<div class="col-md-6">
                			<div class="form-group">
                				<label for="">Sale Total</label>
                				<input type="text" class="form-control" name="" value="{{ \App\returnSaleDetail::where('return_id', $returnProduct->id)->sum('subTotal') }}" readonly>
                			</div>
                		</div>
                        @endif
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