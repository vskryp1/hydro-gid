@extends('backend.layouts.backend')

@section('title', __('backend.edit_delivery'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($delivery, [
                'url'          => route('backend.deliveries.update', ['uuid' => $delivery->id]),
                'method'       => 'PUT',
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