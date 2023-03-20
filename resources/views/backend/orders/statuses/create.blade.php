@extends('backend.layouts.backend')

@section('title', __('backend.order_status_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.orders.statuses.store'),'method'=>'POST','autocomplete'=>'off', 'class'=>'form-horizontal form-label-left']) !!}
            @include('backend.orders.statuses.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    {{ Html::script('assets/backend/modules/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Orders\OrderStatusRequest')->ignore('') !!}
@endsection

@section('styles')
    @parent
    {{ Html::style('assets/backend/modules/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}
@endsection