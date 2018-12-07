@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> ALL CLIENTS</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">CLIENTS</li>
        <li class="breadcrumb-item">All CLIENTS</li>
    </ul>
</div>

<section class="m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark filterable">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('client.create') }}" role="button">Add New Client</a>

                    <button id="filter_button" class="btn btn-primary btn-filter"><i class="fa fa-filter"></i> Filter
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
					    <thead class="bg-dark text-white">
    					    <tr>
    					        <th scope="col">Name</th>
                                <th scope="col">Contact No.</th>
    					        <th scope="col">Previous Due</th>
                                <th scope="col">View</th>
    					    </tr>
					    </thead>
					    <tbody>
                        @if($clients->count() > 0)
					  	@foreach($clients as $client)
        				    <tr>
        				        <td>{{ $client->name }}</td>
                                <td>{{ $client->contact_no }}</td>
        				        <td>{{ $client->previous_due }}</td>
                                <td>
                                    <a href="{{ route('client.show', ['id'=>$client->id]) }}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
        				    </tr>
					    @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No Client Found
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