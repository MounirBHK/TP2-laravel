@extends('layouts.layout')
@section('title', 'Modifier Document')
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/ajouter.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>@lang('lang.h1_edit_doc')</h1>
                        <span class="subheading">@lang('lang.span_College')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->


    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="col-8 text-start pb-5">
                    <h1 class="display-one">@lang('lang.h1_edit_doc')</h1>
                </div>
                <div class="card my-5">
                    <div class="card-header">
                        @lang('lang.h1_edit_doc_of') {{ $user->name }} 
                    </div>

                    
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @php $locale = session()->get('locale'); @endphp
                            <div class="row">

                                @if($locale=='en')
                                <div class="control-group">
                                    <label for="title">@lang('lang.label_title_en')</label>
                                    <input type="text" name="title" id="title" class="form-control mt-2 mb-4" value="{{$document->title}}">
                                    @if($errors->has('title'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('title') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif 
                                </div>
                                @else
                                <div class="control-group">
                                    <label for="title_fr">@lang('lang.label_title_fr')</label>
                                    <input type="text" name="title_fr" id="title_fr" class="form-control mt-2 mb-4" value="{{$document->title_fr}}">
                                    @if($errors->has('title_fr'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('title_fr') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif 
                                </div>
                                @endif

                                <div class="control-group">
                                    <label for="url">@lang('lang.label_doc_download')</label>
                                    <input type="file" name="url" id="url" class="form-control mt-2 mb-4" 
                                    accept="application/msword, text/plain, application/pdf, .zip, .doc, .docx, .txt,.pdf" >
                                    @if($errors->has('url'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                                            <strong>{{ $errors->first('url') }}</strong><br>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif 
                                </div>

                                <input type="hidden" name="old_url" value="{{$document->url}}}">
                                <input type="hidden" name="userId" id="userId" class="form-control mt-2 mb-4" value="{{$user->id}}">
                                
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