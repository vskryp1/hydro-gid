@extends('backend.layouts.backend')

@section('title', __('backend.currency_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.settings.currencies.store'), 'method' => 'POST', 'autocomplete' => 'off']) !!}
            @include('backend.currencies.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Currencies\SaveCurrencyRequest')->ignore('') !!}
@endsection