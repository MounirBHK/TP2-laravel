@extends('layouts.layout')
@section('title', 'Modifier Article')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('../assets/img/img0550.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>@lang('lang.h1_edit_article') </h1>
                        <span class="subheading">@lang('lang.span_College')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->

    <!--
    {{ $article }}
    {{ $user }}
    -->

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="col-8 text-start pb-5">
                    <h1 class="display-one">@lang('lang.h1_edit_article') n° {{$article->id}}</h1>
                </div>
                <div class="card my-5">
                    <div class="card-header">
                        @lang('lang.h1_edit_article')
                    </div>
                    <div class="card-body">
                        <form method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="userId" id="userId" value="{{$user->id}}">

                            <div class="row">
                                <div class="control-group">
                                    <label for="name">@lang('lang.li_author')</label>
                                    <input type="text" name="name" id="name" class="form-control mt-2 mb-4" value="{{$user->name}}" disabled>
                                </div>
                                <div class="control-group">
                                    <label for="title">@lang('lang.label_title_en')</label>
                                    <input type="text" name="title" id="title" class="form-control mt-2 mb-4" value="{{$article->title}}">
                                    @if($errors->has('title'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('title') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif 
                                </div>

                                <div class="control-group">
                                    <label for="body">@lang('lang.label_body_en')</label>
                                    <textarea name="body" id="body" class="form-control mt-2 mb-4">{{$article->body}}</textarea>
                                    @if($errors->has('body'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('body') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif  
                                </div>

                                <div class="control-group">
                                    <label for="title_fr">@lang('lang.label_title_fr')</label>
                                    <input type="text" name="title_fr" id="title_fr" class="form-control mt-2 mb-4" value="{{$article->title_fr}}">
                                    @if($errors->has('title_fr'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('title_fr') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif 
                                </div>

                                <div class="control-group">
                                    <label for="body_fr">@lang('lang.label_body_fr')</label>
                                    <textarea name="body_fr" id="body_fr" class="form-control mt-2 mb-4">{{$article->body_fr}}</textarea>
                                    @if($errors->has('body_fr'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('body_fr') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif  
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