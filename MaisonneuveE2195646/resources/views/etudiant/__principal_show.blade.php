
@extends('layouts.layout')
@section('title', 'Détails Étudiant')
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
    {{$etudiant}}    
    -->
    
    <div class="container">
        <div class="row">
            <div class="col-8 text-start py-5">
                <h1 class="display-one">@lang('lang.h1_details') </h1>
            </div>
            <!--
            <div class="col-4 text-end py-5">
                <a href="{{ route('etudiants') }}" class="btn btn-outline-primary ">@lang('lang.a_back_student_list')</a>
            </div>
            -->
        </div>
        <hr>
        <div class="row">
            <div class="col-12 text-start">
                <div class="display-one">
                    <ul>
                        <li>@lang('lang.li_id') : <span class="fw-bolder">{{$etudiant->id}}</span></li>
                        <li>@lang('lang.li_name') : <span class="fw-bolder">{{$etudiant->nom}}</span></li>
                        <li>@lang('lang.li_adresse') : <span class="fw-bolder">{{$etudiant->adresse}}</span></li>
                        <li>@lang('lang.li_phone') : <span class="fw-bolder">{{$etudiant->phone}}</span></li>
                        <li>@lang('lang.li_email') : <span class="fw-bolder">{{$etudiant->email}}</span></li>
                        <li>@lang('lang.li_B_Date') : <span class="fw-bolder">{{$etudiant->date_de_naissance}}</span></li>
                        <li>@lang('lang.li_ville') : <span class="fw-bolder">{{$etudiant->ville}}</span></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-6 text-end py-5">
                <a href="{{ route('etudiant.edit',$etudiant->id) }}" class="btn btn-outline-success col-4  ">@lang('lang.a_edit')</a>
            </div>
            <div class="col-6 text-start py-5">
                <form method="POST" >
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger col-4 ">@lang('lang.a_delete')</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection