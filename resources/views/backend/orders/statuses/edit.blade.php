@extends('backend.layouts.backend')

@section('title', __('backend.order_status_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model( $order_status, ['route' => ['backend.orders.statuses.update', $order_status->id],'method'=>'PUT','autocomplete'=>'off', 'class'=>'form-horizontal form-label-left']) !!}
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