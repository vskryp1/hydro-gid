@extends('backend.layouts.backend')

@section('title', __('backend/product/index.warranty_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($warranty, [
                'url' => route('backend.products.warranty.update',
                ['product' => $product, 'warranty' => $warranty]),
                'method'=>'PUT',
                "novalidate" => 'novalidate',
                'autocomplete'=>'off',
                'class'=>'form-horizontal validate form-label-left',
                'id'=>'form-product'
            ]) !!}
            <div class="row">
                @include('backend.products.warranty.fields')
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Products\WarrantyRequest')->ignore('') !!}
@endsection