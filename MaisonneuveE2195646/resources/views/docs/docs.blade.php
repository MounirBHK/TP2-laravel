
@extends('layouts.layout')
@section('title', 'Documents')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/etudiants.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>@lang('lang.h1_docs')</h1>
                        <span class="subheading">@lang('lang.span_College')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->

    <!-- 
    {{$listeDocs}}
    -->
    
    <div class="container">
        <div class="row">
            <div class="col-8 text-start py-5">
                <h1 class="display-one">@lang('lang.h1_list_docs')</h1>
            </div>
            <div class="col-4 text-end py-5">
                <a href="{{ route('doc.create') }}" class="btn btn-outline-primary ">@lang('lang.a_new_doc')</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 text-start">

                @forelse($listeDocs as $unDoc)
                    <li><a href="{{ route('doc.show',$unDoc->id) }} " >{{ $unDoc->title }}</a></li>
                @empty
                    <li class="text-wrning">@lang('lang.li_no_docs')</li>
                @endforelse

            </div>
        </div>
        <hr>
    
    </div>
   
@endsection