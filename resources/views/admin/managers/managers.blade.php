@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> ALL MANAGERS</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">MANAGERS</li>
        <li class="breadcrumb-item">ALL MANAGERS</li>
    </ul>
</div>

<section class="m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('manager.create') }}" role="button">Add New Manager</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
					    <thead class="bg-dark text-white">
    					    <tr>
    					        <th scope="col">Name</th>
                                <th scope="col">Email</th>
    					        <th scope="col">Shop</th>
                                <th scope="col">View</th>
    					    </tr>
					    </thead>
					    <tbody>
                        @if($managers->count() > 0)
					  	@foreach($managers as $manager)
        				    <tr>
        				        <td>{{ $manager->name }}</td>
                                <td>{{ $manager->user->email }}</td>
        				        <td>{{ $manager->shop->name }}</td>
                                <td>
                                    <a href="{{ route('manager.show', ['id'=>$manager->id]) }}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
        				    </tr>
					    @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No Manager Found
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