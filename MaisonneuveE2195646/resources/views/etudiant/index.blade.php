@extends('layouts.layout')
@section('title', 'Étudiant Connexion')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/etudiants.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>@lang('lang.h1_list_students')</h1>
                        <span class="subheading">@lang('lang.span_College')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->

    <!-- 
        {{ $listeEtudiants }} 
    -->
    <div class="container">
        <div class="row">
            <div class="col-8 text-start py-5">
                <h1 class="display-one">@lang('lang.h1_list_students')</h1>
            </div>
            <div class="col-4 text-end py-5">
                <a href="{{ route('etudiant.create') }}" class="btn btn-outline-primary ">@lang('lang.h1_new_student')</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 text-start">

                @forelse($listeEtudiants as $unEtudiant)
                    <li><a href="{{ route('etudiant.show',$unEtudiant->id) }} " >{{ $unEtudiant->nom }}</a></li>
                @empty
                    <li class="text-wrning">@lang('lang.li_no_students')</li>
                @endforelse

            </div>
        </div>
        <hr>
    </div>

@endsection