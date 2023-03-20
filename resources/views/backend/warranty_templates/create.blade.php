@extends('backend.layouts.backend')

@section('title', __('backend.warranty_templates_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.products.warranty_templates.store'),'method'=>'POST','autocomplete'=>'off', 'class'=>'form-horizontal form-label-left']) !!}
                @include('backend.warranty_templates.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Products\WarrantyTemplateStoreRequest')->ignore('') !!}
@endsection

@section('styles')
@endsection