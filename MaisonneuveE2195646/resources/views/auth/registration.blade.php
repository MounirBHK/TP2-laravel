@extends('layouts.layout')
@section('title', 'Registration')
@section('content')

<!-- Page Header-->
<header class="masthead" style="background-image: url('../assets/img/home-bg333333.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>@lang('lang.h_registration')</h1>
                    <span class="subheading">@lang('lang.span_College')</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content-->

<main class="signup-form mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 pt-4">
                <div class="card">
                    <h3 class="card-header text-center">@lang('lang.h_registration')</h3>
                    <div class="card-body" >
                        <form action="{{route('user.registration')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" name="name" class="form-control" value="{{ old('name')}}">
                                @if($errors->has('name'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                        <strong>{{ $errors->first('name')}}</strong><br>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div> 
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" placeholder="username" name="email" class="form-control" value="{{ old('email')}}">
                                @if($errors->has('email'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                        <strong>{{ $errors->first('email')}}</strong><br>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div> 
                                @endif
                            </div>
                           
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" name="password" class="form-control">
                                @if($errors->has('password'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                        <strong>{{ $errors->first('password')}}</strong><br>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div> 
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Confirm Password" name="password_confirmation" class="form-control">
                                @if($errors->has('password'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                        <strong>{{ $errors->first('password')}}</strong><br>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div> 
                                @endif
                            </div>
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-primary">@lang('lang.h_registration')</button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



@endsection