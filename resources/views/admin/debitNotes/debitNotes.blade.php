@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> All Debit Notes</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Debit Notes</li>
        <li class="breadcrumb-item">All Debit Notes</li>
    </ul>
</div>

<section class="m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('debitNote.create') }}" role="button">Add New Debit Note</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
					    <thead class="bg-dark text-white">
    					    <tr>
    					        <th scope="col">Date</th>
                                <th scope="col">Client</th>
    					        <th scope="col">Amout</th>
                                <th scope="col">View</th>
    					    </tr>
					    </thead>
					    <tbody>
                        @if($debitNotes->count() > 0)
					  	@foreach($debitNotes as $debitNote)
        				    <tr>
        				        <td>{{ $debitNote->date }}</td>
                                <td>{{ $debitNote->client->name }}</td>
        				        <td>{{ $debitNote->amount }}</td>
                                <td>
                                    <a href="{{ route('debitNote.show', ['id'=>$debitNote->id]) }}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
        				    </tr>
					    @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No Debit Note Found
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