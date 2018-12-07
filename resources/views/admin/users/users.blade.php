@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> ALL USERS</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">USERS</li>
        <li class="breadcrumb-item">All USERS</li>
    </ul>
</div>

<section class="m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header text-right bg-dark">
                    <a class="btn btn-primary" href="{{ route('user.create') }}" role="button">Add User</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
					    <thead class="bg-dark text-white">
    					    <tr>
                                <th scope="col">Image</th>
    					        <th scope="col">Name</th>
                                <th scope="col">Email</th>
    					        <th scope="col">Status</th>
                                <th scope="col">Added Date</th>
                                <th scope="col">View</th>
    					        <th scope="col">Delete</th>
    					    </tr>
					    </thead>
					    <tbody>
                        @if($users->count() > 0)
					  	@foreach($users as $user)
        				    <tr>
                                <td><img src="{{ asset($user->user_image) }}" alt="" style="width:60px;height:60px;"></td>
        				        <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->admin)
                                        <a href="{{ route('user.removeAdmin', ['id'=>$user->id]) }}" class="btn btn-sm btn-danger">Remove Admin</a>
                                    @else
                                        <a href="{{ route('user.makeAdmin', ['id'=>$user->id]) }}" class="btn btn-sm btn-success">Make Admin</a>
                                    @endif
                                </td>
        				        <td>{{ $user->created_at->format('d-m-Y, h:i a') }}</td>
                                <td>
                                    <a href="{{ route('user.show', ['id'=>$user->id]) }}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
        				        <td>
        				      	    <a href="{{ route('user.delete', ['id'=>$user->id]) }}" class="btn btn-danger btn-sm">
        				      		   <i class="fas fa-times-circle"></i>
        				      	    </a>
        				        </td>
        				    </tr>
					    @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger" role="alert">
                                      No User Found
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