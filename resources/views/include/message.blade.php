    @if (session('success'))
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ik ik-x"></i>
            </button>
        </div>
    </div>
    @endif
    @if (session('error'))
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ik ik-x"></i>
            </button>
        </div>
    </div>
    @endif

    @if (session('logout'))
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        .btn-custom.logout:hover {
            color: #FFF;
            text-decoration: none;
        }
    </style>
    <div class="col-md-12 p-0">
        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100">
                    <div class="col-xl-4 col-lg-4 col-md-4 m-auto">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href="http://radmin.rakibhstu.com"><img height="40" src="{{ asset('img/logo.png') }}" alt="RADMIN"></a>
                            </div>
                            {{ session('logout') }}
                            </br>
                            <div class="sign-btn text-center">
                                <br>
                                <button class="btn btn-custom">
                                    <a class="btn-custom logout" href="{{url('login')}}">{{ __('Login')}}</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif