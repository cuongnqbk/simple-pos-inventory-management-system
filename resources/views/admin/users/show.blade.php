@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> VIEW USER</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item">View User</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-dark">
                @if(Auth::id() == $user->id)
                <div class="card-header bg-dark">
                    <h2 class="text-white">Update User</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', ['id'=>$user->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Email</label>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>User Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control{{ $errors->has('user_image') ? ' is-invalid' : '' }}" id="user_image" name="user_image">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Update User</button>
                            </div>
                        </div>
                    </form>
                </div>
                @else
                <div class="card-header bg-dark">
                    <h2 class="text-white">View User</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ $user->name }}">
                            @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ $user->email }}">
                            @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-danger" onclick="window.history.back();" >Back</button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-dark">
                <div class="card-body">
                    <img src="{{ asset($user->user_image) }}" alt="" class="img-bordered img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection