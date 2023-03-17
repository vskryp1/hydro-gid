@extends('backend.layouts.backend')

@section('title', __('backend.delivery_place_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url' => route('backend.deliveries.delivery_places.store',
                ['delivery' => $delivery]),
                'method'=>'POST',
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
