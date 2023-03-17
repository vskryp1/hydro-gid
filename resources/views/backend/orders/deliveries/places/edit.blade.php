@extends('backend.layouts.backend')

@section('title', __('backend.delivery_place_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($delivery_place, [
                'url' => route('backend.deliveries.delivery_places.update',
                ['delivery' => $delivery, 'delivery_place' => $delivery_place]),
                'method'=>'PUT',
                'autocomplete'=>'off',
                'class'=>'form-horizontal form-label-left'
            ]) !!}
                {!! Form::hidden('delivery_id', $delivery) !!}
                @include('backend.orders.deliveries.places.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Orders\Deliveries\DeliveryPlaceRequest')->ignore('') !!}
@endsection