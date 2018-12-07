@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> MY PROFILE</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item">Update Profile</li>
    </ul>
</div>

<div class="row">
        <div class="col-md-12">
            @if($errors->count() > 0)
                @foreach($errors->all() as $error)
                    <span class="text-danger"> {{ $error }} </span><br>
                @endforeach
            @endif
        </div>
    </div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Update Profile</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ $profile->name }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control{{ $errors->has('userName') ? ' is-invalid' : '' }}" name="userName" id="userName" value="{{ $profile->userName }}">
                                @if ($errors->has('userName'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('userName') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if(!Auth::user()->admin)
                                <div class="col-md-12 form-group">
                                    <label>Shop</label>
                                    <select class="form-control{{ $errors->has('shop_id') ? ' is-invalid' : '' }}" name="shop_id" id="shop_id">
                                        @foreach($shops as $shop)
                                        <option value="{{ $shop->id }}" 
                                            @if($shop->id == Auth::user()->shop_id)
                                                selected
                                            @endif
                                            >{{ $shop->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('shop_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('shop_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endif
                            <div class="col-md-6 form-group">
                                <label>Email</label>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ $profile->email }}">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>User Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control{{ $errors->has('user_image') ? ' is-invalid' : '' }}" id="user_image" name="user_image">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    @if ($errors->has('user_image'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('user_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-dark">
                <div class="card-body">
                    <img src="{{ asset($profile->user_image) }}" alt="" class="img-bordered img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection