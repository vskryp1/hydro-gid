@extends('backend.layouts.backend')

@section('title', __('backend.product_status_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.products.statuses.store'),'method'=>'POST','autocomplete'=>'off', 'class'=>'form-horizontal form-label-left']) !!}
                @include('backend.product-statuses.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/modules/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Products\StatusStoreRequest')->ignore('') !!}
@endsection

@section('styles')
        {{ Html::style( asset('assets/backend/modules/bootstrap-colorpicker/css/bootstrap-colorpicker.css')) }}
@endsection