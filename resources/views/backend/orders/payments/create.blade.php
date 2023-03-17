@extends('backend.layouts.backend')

@section('title', __('backend.create_payment'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url'          => route('backend.payments.store'),
                'method'       => 'POST',
                'autocomplete' => 'off',
                'class'        => 'form-horizontal form-label-left',
            ]) !!}
            @include('backend.orders.payments.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style(mix('assets/backend/css/payments.css')) }}
@endsection

@section('scripts')
    {{ Html::script(mix('assets/backend/js/payments.js')) }}
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Orders\Payments\PaymentRequest')->ignore('') !!}
@endsection