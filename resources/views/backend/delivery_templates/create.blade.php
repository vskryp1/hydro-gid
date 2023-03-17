@extends('backend.layouts.backend')

@section('title', __('backend.delivery_templates_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.products.delivery_templates.store'),'method'=>'POST','autocomplete'=>'off', 'class'=>'form-horizontal form-label-left']) !!}
                @include('backend.delivery_templates.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Products\DeliveryTemplateStoreRequest')->ignore('') !!}
@endsection

@section('styles')
@endsection