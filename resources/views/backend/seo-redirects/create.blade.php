@extends('backend.layouts.backend')

@section('title', __('backend.redirect_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.seo-redirects.store'),'method'=>'POST','data-parsley-validate','autocomplete'=>'off']) !!}
            @include('backend.seo-redirects.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Seo\SeoMetasRequest')->ignore('') !!}
@endsection