@extends('backend.layouts.backend')

@section('title', __('backend.value_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url' => route('backend.filters.values.store',
                ['filter' => $filter]),
                'method'=>'POST',
                'autocomplete'=>'off',
                'class'=>'form-horizontal form-label-left'
            ]) !!}
                {!! Form::hidden('filter_id', $filter) !!}
                @include('backend.filters.values.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Filters\Values\SaveRequest')->ignore('') !!}
@endsection
