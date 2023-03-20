@extends('backend.layouts.backend')

@section('title')
    @lang('backend.currency_edit')
@endsection

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($currency, ['url' => route('backend.settings.currencies.update', ['currency' => $currency->id]), 'method' => 'PUT', 'autocomplete' => 'off']) !!}
                @include('backend.currencies.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Currencies\SaveCurrencyRequest')->ignore('') !!}
@endsection