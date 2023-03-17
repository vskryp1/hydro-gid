@extends('backend.layouts.backend')

@section('title', __('backend.delivery_templates_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model( $delivery_template, ['url' => route('backend.products.delivery_templates.update', ['delivery_template' => $delivery_template]),'method'=>'PUT','autocomplete'=>'off', 'class'=>'form-horizontal form-label-left']) !!}
                @include('backend.delivery_templates.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Products\DeliveryTemplateStoreRequest')->ignore('') !!}
@endsection

@section('styles')
@endsection