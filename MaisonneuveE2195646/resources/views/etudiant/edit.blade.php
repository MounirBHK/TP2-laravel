@extends('layouts.layout')
@section('title', 'Modifier Étudiant')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('../assets/img/img0550.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>@lang('lang.h1_Edit_student')</h1>
                        <span class="subheading">@lang('lang.span_College')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->

    <!--
    {{ $listeVilles }}
    {{ $etudiant }}
    {{ $user }}
-->
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="col-8 text-start pb-5">
                    <h1 class="display-one">@lang('lang.h1_edit_student_n') {{$etudiant->id}}</h1>
                </div>
                <div class="card my-5">
                    <div class="card-header">
                        @lang('lang.edit_student_info')
                    </div>
                    <div class="card-body">
                        <form method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="userId" id="userId" value="{{$user->id}}">
                            <div class="row">
                                
                                
                                <div class="control-group">
                                    <label for="name" class="pt-3">@lang('lang.label_nom')</label>
                                    <input type="text" name="name" id="name" class="form-control mt-2" value="{{$user->name}}">
                                    @if($errors->has('name'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('name') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                

                                <div class="control-group">
                                    <label for="adresse" class="pt-3">@lang('lang.label_adresse')</label>
                                    <textarea name="adresse" id="adresse" class="form-control mt-2">@if ($etudiant->adresse) {{$etudiant->adresse}} @else {{ old('adresse')}} @endif</textarea>
                                    @if($errors->has('adresse'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('adresse') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif 
                                </div>

                                <div class="control-group">
                                    <label for="phone" class="pt-3">@lang('lang.label_phone')</label>
                                    <input type="tel" name="phone" id="phone" class="form-control mt-2" value="@if ($etudiant->phone) {{$etudiant->phone}} @else {{ old('phone')}} @endif" >
                                    @if($errors->has('phone'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('phone') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>

                                <div class="control-group">
                                    <label for="email" class="pt-3">@lang('lang.label_email')</label>
                                    <input type="email" name="email" id="email" class="form-control mt-2" value="{{$user->email}}" >
                                    @if($errors->has('email'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('email') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>

                                <div class="control-group">
                                    <label for="date_de_naissance" class="pt-3">@lang('lang.label_B_Date')</label>
                                    <input type="date" name="date_de_naissance" id="date_de_naissance" class="form-control mt-2" value="@if ($etudiant->date_de_naissance) {{$etudiant->date_de_naissance}} @else {{ old('date_de_naissance')}} @endif">
                                    @if($errors->has('date_de_naissance'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('date_de_naissance') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="control-group">
                                    <label for="villeId" class="pt-3">@lang('lang.label_ville')</label>

                                    <select name="villeId">
                                    @foreach ($listeVilles as $ville)
                                        <option value="{{ $ville->id }}"
                                        @if ($ville->id == $etudiant->villeId)
                                        
                                            selected="selected"
                                        
                                        @endif
                                        >{{ $ville->id }} - {{ $ville->nom }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="control-group d-grid py-3">
                                    <input type="submit" class="btn btn-success mt-2" value="@lang('lang.label_envoyer')">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    

@endsection