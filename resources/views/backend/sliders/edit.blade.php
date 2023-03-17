@extends('backend.layouts.backend')

@section('title', __('backend.slider_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($slider , [
                'url' => route('backend.sliders.update',
                ['slider' => $slider->id]),
                'method'=>'PUT',
                'autocomplete'=>'off',
                'class'=>'form-horizontal form-label-left'
            ]) !!}
                @include('backend.sliders.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Sliders\StoreRequest', 'form')->ignore('') !!}
@endsection