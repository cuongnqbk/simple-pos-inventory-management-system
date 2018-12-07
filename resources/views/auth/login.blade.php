<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Anwarul Islam & Sons</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="{{ asset('vali/css/jquery-ui.css') }}" type="text/css" rel="stylesheet" />
    <!-- Styles -->
    <!-- <link href="{{ asset('vali/css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('vali/css/toastr.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet">
    <link href="{{ asset('vali/css/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vali/css/filter-table.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/pm/gijgo@1.9.4/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="{{ asset('vali/css/table.css')}}">
    <link rel="stylesheet" href="{{ asset('vali/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('vali/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('vali/css/responsive.css')}}">
</head>

<body>
    <!-- ========================<Login Part Start >====================== -->
    <section class="login-page-part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="login-part">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="login-left d-sm-none d-none d-md-block">
                                    <!-- <h2>Login</h2> </br>
                                    <h4>Join Us And Share Your Opinion</h4> -->
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="login-right">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="login-form">
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>User Name</label>
                                                        <input type="text" class="form-control {{ $errors->has('userName') ? ' is-invalid' : '' }}" name="userName" value="{{ old('userName') }}" required autofocus >
                                                        @if ($errors->has('userName'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('userName') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required >

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="checkbox">
                                                  <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    Remember Password
                                                  </label>
                                                  <a href="{{ route('password.request') }}" class="float-right">Forgot Password?</a>
                                                </div>
                                                <div>
                                                    <button class="btn btn-info btn-lg login-button" type="submit">
                                                        Login
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('vali/js/jquery-3.3.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('vali/js/popper.min.js') }}" defer></script>
    <script type="text/javascript" language="javascript" src="{{ asset('vali/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('vali/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('vali/js/toastr.min.js') }}"></script>
    <script src="{{ asset('vali/js/table.js') }}"></script>
    <!-- =========New JS Files======== -->
    <script src="{{ asset('vali/js/plugins/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('vali/js/plugins/moment.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script src="{{ asset('vali/js/plugins/sweetalert.min.js')}}"></script>
    <script src="{{ asset('vali/js/plugins/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('vali/js/plugins/pace.min.js')}}"></script>
    <!-- =========New JS Files======== -->
    <script src="{{ asset('vali/js/main.js')}}"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{Session::get('error')}}");
        @endif
    </script>
    
    <!-- Other Javascripts -->

    <!-- Custom JS -->
    <script>
        var windowHeight = $(window).height();
        $('body').css("height", windowHeight);
        $('.login-page-part').css("height", windowHeight);
    </script>
</body>

</html>