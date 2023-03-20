@extends('backend.layouts.backend')

@section('title', __('backend.seo_metatag_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.seo-metas.store'),'method'=>'POST','data-parsley-validate','autocomplete'=>'off']) !!}
            @include('backend.seo-metas.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Seo\SeoRedirectsRequest')->ignore('') !!}
@endsection