@extends('layouts.layout')
@section('title', 'Détails Article')
@section('content')
    
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('../assets/img/rec09.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>@lang('lang.h1_details_article')</h1>
                        <span class="subheading">@lang('lang.span_College')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
<!-- 
{{$article}}    
-->
    @php $locale = session()->get('locale'); @endphp
    <div class="container">
        <div class="row">
            <div class="col-8 text-start py-5">
                <h1 class="display-one">@lang('lang.h1_details_article')</h1>
            </div>
            <div class="col-4 text-end py-5">
                <a href="{{ route('forum') }}" class="btn btn-outline-primary ">@lang('lang.a_list_articles')</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 text-start">
                <div class="display-one">
                    <ul>
                        <li>@lang('lang.li_author') : <span class="fw-bolder">{{$article->nom}}</span></li>
                        <li>@lang('lang.li_title') : <span class="fw-bolder">{{$article->title}}</span></li>
                        <li>@lang('lang.li_body') : <span class="fw-bolder">{{$article->body}}</span></li>
                        <li>@lang('lang.li_created')  : <span class="fw-bolder">{{$article->created_at}}</span></li>
                        <li>@lang('lang.li_updated') : <span class="fw-bolder">{{$article->updated_at}}</span></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        @php $userId = session()->get('id'); @endphp
        @if($article->userId == $userId)
        <div class="row">
            <div class="col-6 text-end py-5">
                <a href="{{ route('article.edit',$article->id) }}" class="btn btn-outline-success col-4  ">@lang('lang.a_edit')</a>
            </div>
            <div class="col-6 text-start py-5">
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger col-4 ">@lang('lang.a_delete')</button>
                </form>
            </div>
        </div>
        @endif
    </div>
    
@endsection

