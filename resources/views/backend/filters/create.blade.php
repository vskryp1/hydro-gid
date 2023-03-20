@extends('backend.layouts.backend')

@section('title', __('backend.filter_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url' => route('backend.filters.store'),
                'method'=>'POST',
                'autocomplete'=>'off',
                'class'=>'form-horizontal form-label-left'
            ]) !!}
                @include('backend.filters.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style(mix('assets/backend/css/filters.css')) }}
@endsection

@section('scripts')
    {{ Html::script(mix('assets/backend/js/filters.js')) }}
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Filters\SaveRequest')->ignore('') !!}
@endsection