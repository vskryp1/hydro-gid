@extends('backend.layouts.backend')

@section('title', __('backend.create_settings'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url'          => route('backend.settings.global.store'),
                'method'       => 'POST',
                'autocomplete' => 'off',
                'class'        => 'form-horizontal form-label-left',
            ]) !!}
            @include('backend.settings.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\SettingsRequest')->ignore('') !!}
@endsection