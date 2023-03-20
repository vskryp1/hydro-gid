@extends('backend.layouts.backend')

@section('title', __('backend.slider_item_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($slider_item, [
                'url' => route('backend.sliders.slider_items.update',
                ['slider' => $slider, 'slider_item' => $slider_item]),
                'method'=>'PUT',
                'autocomplete'=>'off',
                'files' => true,
                'class'=>'form-horizontal form-label-left'
            ]) !!}
                {!! Form::hidden('slider_id', $slider) !!}
                @include('backend.sliders.items.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Sliders\StoreSliderItemRequest')->ignore('') !!}
@endsection