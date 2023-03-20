@extends('backend.layouts.backend')

@section('title', __('backend.create_region'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url'          => route('backend.settings.regions.store'),
                'method'       => 'POST',
                'autocomplete' => 'off',
                'class'        => 'form-horizontal form-label-left',
            ]) !!}
            @include('backend.regions.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style(mix('assets/backend/css/regions.css')) }}
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Regions\RegionRequest')->ignore('') !!}
    {{ Html::script(mix('assets/backend/js/regions.js')) }}
@endsection