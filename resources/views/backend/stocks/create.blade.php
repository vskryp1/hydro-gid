@extends('backend.layouts.backend')

@section('title')
    @lang('backend/stocks/index.create')
@endsection

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url'    => route('backend.stocks.store'),
                'method' => 'POST',
                'class'  => 'form-horizontal form-label-left',
                'files'  => true,
            ]) !!}
            @include('backend.stocks.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style(mix('assets/backend/css/stocks.css')) }}
@endsection

@section('scripts')
    <script>
        window.custom_var = {
            placeholder: '@lang('backend/app.select_from')'
        };
    </script>
    {{ Html::script(mix('assets/backend/js/stocks.js')) }}
    {!! JsValidator::formRequest('App\Http\Requests\Backend\Stock\StoreRequest') !!}
@endsection