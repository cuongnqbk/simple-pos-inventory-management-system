@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> ADD USER</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item">Add User</li>
    </ul>
</div>

<section class="allExpense-part m-t-80 m-b-50">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Add User</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Email</label>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Shop</label>
                                <select class="form-control{{ $errors->has('shop_id') ? ' is-invalid' : '' }}" name="shop_id" id="shop_id">
                                    <option selected disabled>Choose an Option</option>
                                    @foreach($shops as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('shop_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('shop_id') }}</strong>
                                </span>
                            @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Password</label>
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" value="">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation" value="">
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="submit">Add User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection