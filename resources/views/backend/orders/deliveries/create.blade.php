@extends('backend.layouts.backend')

@section('title', __('backend.create_delivery'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url'          => route('backend.deliveries.store'),
                'method'       => 'POST',
                'autocomplete' => 'off',
                'class'        => 'form-horizontal form-label-left',
            ]) !!}
            @include('backend.orders.deliveries.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style(mix('assets/backend/css/deliveries.css')) }}
@endsection

@section('scripts')
    {{ Html::script(mix('assets/backend/js/deliveries.js')) }}
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Orders\Deliveries\DeliveryRequest')->ignore('') !!}
@endsection