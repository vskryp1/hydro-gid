{{ Form::open(['route' => 'frontend.forms.checkout.step2', 'method' => 'POST', 'id' => 'delivery_payment_form'])}}
@foreach($deliveries as $delivery)
    <label class="radio">
        {{ Form::radio(
            'delivery_id',
            $delivery->id,
            $current_delivery->id === $delivery->id,
            ['class' => 'js-delivery-radio', 'data-type' => $delivery->type->key, 'data-type-id' => $delivery->type]
        ) }}
        <span>{{ $delivery->name }}</span>
    </label>
@endforeach
{{ Form::hidden('delivery_type', $current_delivery->type->value, ['class' =>'js-delivery-type-input']) }}

<div class="js-delivery-blocks"></div>

<div class="checkout__form-title">@lang('frontend/checkout/index.pay')</div>
@foreach($payments as $payment)
    <label class="radio">
        {{ Form::radio(
            'payment_id',
            $payment->id,
            $current_payment->id === $payment->id,
            ['class' => 'js-payment-radio', 'data-type' => $payment->type->key, 'data-type-id' => $payment->type]
        ) }}
        <span @if($payment->type->is(PaymentType::PRIVAT24_BY_PART)) @endif>
            {{ $payment->name }}
{{--            @if($payment->type->is(PaymentType::LIQPAY))--}}
 {{--               <img src="{{asset('/assets/frontend/images/liqpay.png')}}" alt="">--}}
{{--            @elseif($payment->type->is(PaymentType::PRIVAT24_BY_PART))--}}
{{--                <img src="{{asset('/assets/frontend/images/pb.png')}}" alt=""> --}}
{{--@lang('frontend/checkout/index.part_pay')--}}
            {{--    @else--}}

         {{--   @endif--}}
        </span>
    </label>
@endforeach
{{ Form::hidden('payment_type', $current_payment->type->value, ['class' =>'js-payment-type-input']) }}
<div class="js-payments-blocks"></div>

@section('scripts')
    @parent
    <script>
                window.routes                     = {};
                window.translates                 = {};
                window.data                       = {};
                window.routes.change_delivery     = '{!! route('ajax.cart.delivery', ['delivery' => null]) !!}';
                window.routes.change_payment      = '{!! route('ajax.cart.change_payment', ['payment' => null]) !!}';
                window.routes.search_delivery     = '{!! route('ajax.cart.delivery_place', ['delivery' => null]) !!}';
                window.translates.search          = "@lang('frontend.search_city')";
                window.translates.search_message  = "@lang('frontend.search_message')";
                window.translates.not_found_message = "@lang('frontend.not_found_message')";
                window.translates.searching_message = "@lang('frontend.searching_message')";
                window.data.map_zoom              = {{ config('app.google_api.maps_zoom') }};
    </script>
    <!-- Replace the value of the key parameter with your own API key. -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api.key') }}" async defer></script>
@endsection
