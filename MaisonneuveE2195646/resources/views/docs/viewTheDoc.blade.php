@extends('layouts.layout')
@section('title', 'Détails Document')
@section('content')
    
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('../assets/img/rec09.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>@lang('lang.h1_details')</h1>
                        <span class="subheading">@lang('lang.span_College')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
<!-- 
 
-->
    
    <iframe src="/storage/fichiers/{{$document->url}}" 
        style="
        position: fixed;
        top: 0px;
        bottom: 0px;
        right: 0px;
        width: 100%;
        border: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        z-index: 999999;
        height: 100%;
        ">
    </iframe>


@endsection

