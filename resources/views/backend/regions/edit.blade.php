@extends('backend.layouts.backend')

@section('title', __('backend.edit_region'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($region, [
                'url'          => route('backend.settings.regions.update', ['uuid' => $region->id]),
                'method'       => 'PUT',
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