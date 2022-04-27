    @if (session('logout') || session('error') || session('success'))
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        .auth-wrapper {
            background: #f4f4f4;
        }

        .auth-wrapper .authentication-form {
            border: 1px solid #002d72;
        }

        .btn-custom.logout:hover {
            color: #FFF;
            text-decoration: none;
        }

        button#logout_btnDiv {
            padding: 0;
            background: #002d72;
        }

        /* 2400336341 */
        .btn-custom.logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            /* background-color: #009688; */
            background-color: #002d72;
            height: 30px;
            color: #fff;
            border-radius: 25px;
        }
    </style>
    <div class="col-md-12 p-0">
        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100">
                    <div class="col-xl-4 col-lg-4 col-md-4 m-auto">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href="http://radmin.rakibhstu.com"><img height="80" src="{{ asset('img/metro-logo-sk.png') }}" alt="RADMIN"></a>
                            </div>
                            @if (session('success'))
                            {{ session('success') }}
                            @endif

                            @if (session('logout'))
                            {{ session('logout') }}
                            @endif

                            @if (session('error'))
                            {{ session('error') }}
                            @endif

                            </br>

                            <div class="sign-btn text-center">
                                <br>
                                <button class="btn btn-custom" id="logout_btnDiv">
                                    @guest
                                    <a class="btn-custom logout" href="{{url('login')}}">{{ __('Login')}}</a>
                                    @endguest
                                    @auth
                                    <a class="btn-custom logout" href="{{url('customer')}}">{{ __('Home Page')}}</a>
                                    @endauth
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif