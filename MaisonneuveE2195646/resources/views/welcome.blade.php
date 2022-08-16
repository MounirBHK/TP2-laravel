@extends('layouts.layout')
@section('title', 'Welcome')
@section('content')

<!--
{{session()->get('locale')}}
-->

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>@lang('lang.h1_Student_Management_Platform')</h1>
                        <span class="subheading">@lang('lang.span_College')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->

    

    <div class="container">
        <div class="row">
            <div class="col-12 text-center py-5">
                <h1 class="display-one">@lang('lang.h1_Welcome')</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row">
            @guest
            <div class="col-12 text-center py-5 ">
                <a href="{{ route('login') }}" class="btn btn-outline-primary ">@lang('lang.text_Login')</a>
                <a href="{{ route('registration') }}" class="btn btn-outline-primary ">@lang('lang.text_Registration')</a>
            </div>
            @else
            <div class="col-12 text-center py-5 ">
                <a href="{{ route('logout') }}" class="btn btn-outline-primary ">@lang('lang.a_Logout')</a>
                
            </div>
            @endguest

        </div>
    </div>

@endsection