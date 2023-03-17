<div class="orders personal__tab-content">
    @if(($cur_orders = $data['current_orders']->count()) || ($data['history_orders']->count()))
        @if($cur_orders)
            <div class="personal_table current_order">
                <table>
                    <thead>
                    <tr>
                        <th class="order__data"></th>
                        <th class="order__vendor-code">
                            {{ __('frontend/profile/index.data_order') }}
                        </th>
                        <th class="order__text">
                            {{ __('frontend/profile/index.product') }}
                        </th>
                        <th class="order__price">
                            {{ __('frontend/profile/index.price') }}
                        </th>
                        <th class="order__sum">
                            {{ __('frontend/profile/index.quantity') }}
                        </th>
                        <th class="order__value">
                            {{ __('frontend/profile/index.cost') }}
                        </th>
                        <th colspan="3" class="order__status">
                            {{ __('frontend/profile/index.status') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['current_orders'] as $order)
                        @if($order->products->count() === 1)
                            <tr>
                                <td class="order__img">
                                    @include('frontend.elements.order.image_block', ['product' => $order->products->first()])
                                </td>
                                <td data-label="Дата/Номер заказа" class="order__vendor-code">
                                    <p class="data">{{ $order->created_at->format('Y-m-d') }}</p>
                                    <p>{{ $order->unique_id }}</p>
                                </td>
                                <td data-label="{{ __('frontend/profile/index.product') }}" class="order__text">
                                    <a href="{{ $order->products->first()->alias }}">
                                        {{ $order->products->first()->name }}
                                        {{ $order->products->first()->getWarrantyText() }}
                                    </a>
                                </td>
                                <td data-label="{{ __('frontend/profile/index.price') }}" class="order__price">
                                    {{ $order->products->first()->format_total_unit_price }}
                                    {{ __('frontend/product/index.uah') }}
                                </td>
                                <td data-label="Кол-во" class="order__sum">
                                    {{ $order->products->first()->pivot->qty }}
                                </td>
                                <td data-label="{{ __('frontend/profile/index.cost') }}" class="order__value">
                                    {{ $order->formatted_total_price }}
                                    {{ __('frontend/product/index.uah') }}
                                    @if( $order->discount > 0)
                                        (-{{ $order->formatted_discount }} @lang('frontend/product/index.uah'))
                                    @endif
                                </td>
                                <td data-label="{{ __('frontend/profile/index.status') }}" class="order__status paid">
                                    {{ $order->order_status->name }}
                                </td>
                                <td class="order__pay js_location-btn">
{{--                                    <a href="{{ route('frontend.payment_page', [\App\Models\Order\Payment::where('type', PaymentType::LIQPAY)->first(), $order]) }}"--}}
{{--                                       class="main-btn--green">--}}
{{--                                        {{ __('frontend/profile/index.paid') }}--}}
{{--                                    </a>--}}
                                </td>
                                @if($order->ttn)
                                    <td class="order__track js_location-btn">
                                        @if($order->delivery->type->is(DeliveryType::PICKUP_NP))
                                            <a href="https://novaposhta.ua/{{ App::getLocale() }}/tracking/?cargo_number={{ $order->ttn }}"
                                               target="_blank"
                                               rel="nofollow" class="main-btn--green text-lg-center">
                                                {{ __('frontend/profile/index.track_order') }}
                                            </a>
                                        @elseif($order->delivery->type->is(DeliveryType::COURIER_NP))
                                            <a href="https://novaposhta.ua/{{ App::getLocale() }}/tracking/?cargo_number={{ $order->ttn }}"
                                               target="_blank"
                                               rel="nofollow" class="main-btn--green">
                                                {{ __('frontend/profile/index.track_order') }}
                                            </a>
                                        @endif
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @else
                            <tr class="more" data-open="{{ $order->id }}">
                                <td class="order__img"></td>
                                <td data-label="Дата/Номер заказа" class="order__vendor-code">
                                    <p class="data">{{ $order->created_at->format('Y-m-d') }}</p>
                                    <p>{{ $order->unique_id }}</p>
                                </td>
                                <td data-label="{{ __('frontend/profile/index.product') }}" class="order__text">
                                    {{ $order->products->count() }} {{ __('frontend/profile/index.qty') }}
                                </td>
                                <td data-label="{{ __('frontend/profile/index.price') }}" class="order__price"></td>
                                <td data-label="Кол-во" class="order__sum"></td>
                                <td data-label="{{ __('frontend/profile/index.cost') }}" class="order__value">
                                    {{ $order->formatted_total_price }}
                                    {{ __('frontend/product/index.uah') }}
                                    @if( $order->discount > 0)
                                        (-{{ $order->formatted_discount }} @lang('frontend/product/index.uah'))
                                    @endif
                                </td>
                                <td data-label="{{ __('frontend/profile/index.status') }}" class="order__status paid">
                                    {{ $order->order_status->name }}
                                </td>
                                <td class="order__pay js_location-btn">
{{--                                    <a href="{{ route('frontend.payment_page', [\App\Models\Order\Payment::where('type', PaymentType::LIQPAY)->first(), $order]) }}"--}}
{{--                                       class="main-btn--green">--}}
{{--                                        {{ __('frontend/profile/index.paid') }}--}}
{{--                                    </a>--}}
                                </td>
                                @if($order->ttn)
                                    <td class="order__track js_location-btn">
                                        @if($order->delivery->type->is(DeliveryType::PICKUP_NP))
                                            <a href="https://novaposhta.ua/{{ App::getLocale() }}/tracking/?cargo_number={{ $order->ttn }}"
                                               target="_blank"
                                               rel="nofollow" class="main-btn--green text-lg-center">
                                                {{ __('frontend/profile/index.track_order') }}
                                            </a>
                                        @elseif($order->delivery->type->is(DeliveryType::COURIER_NP))
                                            <a href="https://novaposhta.ua/{{ App::getLocale() }}/tracking/?cargo_number={{ $order->ttn }}"
                                               target="_blank"
                                               rel="nofollow" class="main-btn--green">
                                                {{ __('frontend/profile/index.track_order') }}
                                            </a>
                                        @endif
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                            @foreach($order->products as $product)
                                <tr class="more_open more_open_{{ $order->id }}">
                                    <td class="order__img">
                                        @include('frontend.elements.order.image_block', ['product' => $product])
                                    </td>
                                    <td data-label="Дата/Номер заказа" class="order__vendor-code"></td>
                                    <td data-label="{{ __('frontend/profile/index.product') }}" class="order__text">
                                        <a href="{{ $product->alias }}">
                                            {{ $product->name }}
                                            {{ $product->getWarrantyText() }}
                                        </a>
                                    </td>
                                    <td data-label="{{ __('frontend/profile/index.price') }}" class="order__price">
                                        {{ $product->format_total_unit_price }}
                                        {{ __('frontend/product/index.uah') }}
                                    </td>
                                    <td data-label="Кол-во" class="order__sum">
                                        {{ $product->pivot->qty }}
                                    </td>
                                    <td data-label="{{ __('frontend/profile/index.cost') }}" class="order__value"></td>
                                    <td data-label="{{ __('frontend/profile/index.status') }}"
                                        class="order__status paid"></td>
                                    <td class="order__track"></td>
                                    <td class="order__track2"></td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        @include('frontend.templates.account.orders.include.order_history')
    @else
        {{ __('frontend.orders_not_found') }}
    @endif
</div>
