@extends('layouts.layout')
@section('title', 'Villes')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/villes.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>@lang('lang.h1_list_cities') </h1>
                        <span class="subheading">@lang('lang.span_College')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->

    <!-- {{ $listeVilles }} -->
    <div class="container">
        <div class="row">
            <div class="col-12 text-start pt-5">
                <h1 class="display-one">@lang('lang.h1_list_cities')</h1>
            </div>
        </div>
    
        <div class="row">
            <div class="col-12 text-start">
                <div class="display-one">
                
                    @forelse($listeVilles as $ville)
                        <li>{{ $ville->nom }}</li>
                    @empty
                        <li class="text-wrning">@lang('lang.li_no_cities')</li>
                    @endforelse
                    
                </div>
            </div>
        </div> 
    </div>
    
    <hr>

@endsection