@extends('layouts.main')
@section('title', 'Customers')
@section('content')
<style>
    .btn-custom.logout:hover {
        color: #FFF;
        text-decoration: none;
    }

    .btn-custom.logout {
        display: inline-block;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background-color: #009688;
        height: 40px;
        color: #fff;
        border-radius: 25px;
    }
</style>



@if (session('logout'))
<div class="col-md-12 p-0">
    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100">
                <div class="col-xl-4 col-lg-4 col-md-4 m-auto">
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="http://radmin.rakibhstu.com"><img height="40" src="{{ asset('img/logo.png') }}" alt="RADMIN"></a>
                        </div>
                        <!-- {{ session('logout') }} -->
                        You have successfully logged out.
                        </br>
                        <div class="sign-btn text-center">
                            <br>
                            <!-- <button class="btn btn-custom"> -->
                            <a class="btn-custom logout" href="{{url('login')}}">{{ __('Login')}}</a>
                            <!-- </button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
@endsection