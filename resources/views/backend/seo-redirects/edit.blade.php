@extends('backend.layouts.backend')

@section('title', __('backend.redirect_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($redirect, ['url' => route('backend.seo-redirects.update',['id' => $redirect->id]),'method'=>'PUT', 'data-parsley-validate','autocomplete'=>'off']) !!}
            @include('backend.seo-redirects.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Seo\SeoMetasRequest')->ignore('') !!}
@endsection