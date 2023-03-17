@extends('backend.layouts.backend')

@section('title', __('backend/product/index.warranty_create_new'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
            'url' => route('backend.products.warranty.store', $product),
            'method'=>'POST',
            'autocomplete'=>'off',
             "novalidate" => 'novalidate',
            'class'=>'form-horizontal validate form-label-left']) !!}
                @include('backend.products.warranty.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Products\WarrantyRequest')->ignore('') !!}
@endsection