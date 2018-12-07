@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Product Entry Report</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Report</li>
        <li class="breadcrumb-item">Product Entry Report</li>
    </ul>
</div>

<section class="allExpense-part m-b-50">

    <div class="row p-t-25">
        <div class="col">
            <div class="card border-dark">
            	<div class="card-header bg-dark">
                    <h4 class="text-white">Product Entry Report</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
					  <thead class="bg-dark text-white">
					    <tr>
					      <th scope="col">Product</th>
					      <th scope="col">Shop</th>
					      <th scope="col">Quantity</th>
					      <th scope="col">Total Cost</th>
					      <th scope="col">Date</th>
					    </tr>
					  </thead>
					  	<tbody>
						  	@if($entries->count() > 0)
						    	@foreach($entries as $entry)
						    	<tr>
							      	<td>{{ \App\Product::where('id', $entry->product_id)->first()->productName }}</td>
							      	<td>{{ \App\Shop::where('id', $entry->shop_id)->first()->name }}</td>
							      	<td>{{ $entry->quantity }}</td>
							      	<td>{{ $entry->total_cost }}</td>
							      	<td>{{ $entry->created_at->format('d-m-y, h:ia') }}</td>
						    	</tr>
						    	@endforeach
						    @else
	                            <tr>
	                                <td colspan="4" class="text-center">
	                                    <div class="alert alert-danger" role="alert">
	                                      No Entry Found
	                                    </div>
	                                </td>
	                            </tr>
	                        @endif
					  	</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection