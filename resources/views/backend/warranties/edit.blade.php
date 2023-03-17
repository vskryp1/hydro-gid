@extends('backend.layouts.backend')

@section('title', __('backend/product/index.warranty_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model( $warranty, [
                     'url' => route('backend.warranties.update', $warranty),
                     'method'=>'PUT','autocomplete'=>'off',
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

@section('styles')
@endsection