@extends('backend.layouts.backend')

@section('title', __('backend/product/index.warranty_create_new'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url' => route('backend.warranties.store'),
                'method'=>'POST','autocomplete'=>'off',
                'class'=>'form-horizontal form-label-left'
             ]) !!}
                @include('backend.warranties.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\WarrantyRequest')->ignore('') !!}
@endsection