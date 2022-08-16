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
{{$document->url}}    
-->
    @php $locale = session()->get('locale'); @endphp
    <div class="container">
        <div class="row">
            <div class="col-8 text-start py-5">
                <h1 class="display-one">@lang('lang.h1_details')</h1>
            </div>
            <div class="col-4 text-end py-5">
                <a href="{{ route('docs') }}" class="btn btn-outline-primary ">@lang('lang.h1_list_docs')</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 text-start">
                <div class="display-one">
                    <ul>
                        
                        <li>@lang('lang.label_title_en') : <span class="fw-bolder">{{$document->title}}</span></li>
                        <li>@lang('lang.label_title_fr') : <span class="fw-bolder">{{$document->title_fr}}</span></li>
                        <li>@lang('lang.li_url') : <a href="{{route('doc.view',$document->id)}}" class="fw-bolder">{{$document->url}}</a></li>
                        <iframe class="py-5 center" height="600" width="600" src="/storage/fichiers/{{$document->url}}" frameborder="0"></iframe>
                        <li>@lang('lang.li_created')  : <span class="fw-bolder">{{$document->created_at}}</span></li>
                        <li>@lang('lang.li_updated') : <span class="fw-bolder">{{$document->updated_at}}</span></li>
    
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        @php $userId = session()->get('id'); @endphp
        <div class="row">
            @if($document->userId == $userId)
            <div class="col-4 text-end py-5">
                <a href="{{ route('doc.edit',$document->id) }}" class="btn btn-outline-success   ">@lang('lang.a_edit')</a>
            </div>
            <div class="col-4 text-center py-5">
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger  ">@lang('lang.a_delete')</button>
                </form>
            </div>
            @endif
            <div class="col-4 text-start py-5">
                <a href="{{ route('doc.download',$document->id) }}" class="btn btn-outline-success   ">@lang('lang.a_download')</a>
            </div>
        </div>
        

    </div>
    
@endsection

