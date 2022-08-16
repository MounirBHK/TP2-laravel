@extends('layouts.layout')
@section('title', 'Espace Étudiant')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/ajouter.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>@lang('lang.h1_myspace')</h1>
                        <span class="subheading">@lang('lang.span_College')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <!--
    {{$listeVilles}}
    {{$user}}
    -->

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="col-8 text-start pb-5">
                    <h1 class="display-one">@lang('lang.h1_private')</h1>
                </div>
                <div class="card my-5">
                    <div class="card-header">
                    @lang('lang.div_info')
                    </div>
                    <div class="card-body">
                        <form action="{{ route('etudiant.edit')}}" method="post">
                            @csrf
                            <div class="row">
                                
                                <div class="control-group">
                                    <label for="nom">@lang('lang.label_nom')</label>
                                    <input type="text" name="nom" id="nom" class="form-control mt-2 mb-4" value="{{$user->name}}" disabled>
                                </div>

                                <div class="control-group">
                                    <label for="adresse">@lang('lang.label_adresse')</label>
                                    <textarea name="adresse" id="adresse" class="form-control mt-2 mb-4" >{{ old('adresse') }}</textarea> 
                                    @if($errors->has('adresse'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('adresse')}}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>

                                <div class="control-group">
                                    <label for="villeId">@lang('lang.label_ville')</label>
                                    <select name="villeId" class="form-control mt-2 mb-4">
                                    @foreach ($listeVilles as $ville)
                                        <option value="{{ $ville->id }}">{{ $ville->id }} - {{ $ville->nom }}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="control-group">
                                    <label for="phone">@lang('lang.label_phone')</label>
                                    <input type="tel" name="phone" id="phone" class="form-control mt-2 mb-4">
                                    @if($errors->has('phone'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('phone')}}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="control-group">
                                    <label for="email">@lang('lang.label_email')</label>
                                    <input type="email" name="email" id="email" class="form-control mt-2 mb-4" value="{{$user->email}}" disabled>
                                </div>
                             
                                
                                <input type="hidden" name="userId" id="userId" class="form-control mt-2 mb-4" value="{{$user->id}}">
                                
                                
                                <div class="control-group">
                                    <label for="date_de_naissance">@lang('lang.label_B_Date')</label>
                                    <input type="date" name="date_de_naissance" id="date_de_naissance" class="form-control mt-2 mb-4">
                                    @if($errors->has('adresse'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('adresse')}}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="control-group d-grid py-3">
                                    <input type="submit" class="btn btn-success mt-2 mb-4" value="@lang('lang.label_envoyer')">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    

@endsection