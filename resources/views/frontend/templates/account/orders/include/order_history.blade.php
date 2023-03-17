@if($data['history_orders']->count())
    <div class="personal__tab-title">
        {{ __('frontend/profile/index.orders_history') }}
    </div>
    <div class="personal_table">
        <table>
            <tbody>
            <tr>
                <th class="order__data">
                    {{ __('frontend/profile/index.data_order') }}
                </th>
                <th class="order__text">
                    {{ __('frontend/profile/index.product') }}
                </th>
                <th class="order__vendor-code">
                    {{ __('frontend/profile/index.sku') }}
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
            @php
                $count = 0
            @endphp
            @foreach($data['history_orders'] as $order)
                <tr @if($order->products->count() > 1) class="more"
                    data-open="{{ $order->products->count() > 1 ? $count : null }}" @endif>
                    <td data-label="{{ __('frontend/profile/index.date') }}" class="order__data">
                        {{ $order->created_at->format('Y-m-d') }}
                        <p>{{ $order->unique_id }}</p>
                    </td>
                    <td data-label="{{ __('frontend/profile/index.product') }}" class="order__text">
                        @if($order->products->count() === 1)
                            <a href="{{ $order->products->first()->alias }}">{{ $order->products->first()->name }}</a>
                        @else
                            {{ $order->products->count() }}
                            {{ trans_choice('frontend/profile/index.positions_in_order', $order->products->count()) }}
                            <i class="icon icon-arrow-down"></i>
                        @endif
                    </td>
                    <td data-label="{{ __('frontend/profile/index.sku') }}" class="order__vendor-code">
                        @if($order->products->count() === 1)
                            {{ $order->products->first()->sku }}
                        @endif
                    </td>
                    <td data-label="{{ __('frontend/profile/index.price') }}" class="order__price">
                        @if($order->products->count() === 1)
                            {{ $order->products->first()->format_total_unit_price }}
                            @lang('frontend/product/index.uah')
                        @endif
                    </td>
                    <td data-label="{{ __('frontend/profile/index.quantity') }}" class="order__sum">
                        @if($order->products->count() === 1)
                            {{ $order->products->first()->pivot->qty }}
                        @endif
                    </td>
                    <td data-label="{{ __('frontend/profile/index.cost') }}" class="order__value">
                        {{ $order->formatted_total_price }}
                        @lang('frontend/product/index.uah')
                        @if( $order->discount > 0)
                            (-{{ $order->formatted_discount }} @lang('frontend/product/index.uah'))
                        @endif
                    </td>
                    <td data-label="{{ __('frontend/profile/index.status') }}" class="order__status paid">
                        {{ $order->order_status->name }}
                    </td>
                    <td data-label="" class="order__track js_location-btn">
                        @if(!in_array($order->order_status->name, ['Отменен', 'Скасовано','Доставлен', 'Доставлений']))
                            @if($order->delivery->type->is(DeliveryType::PICKUP_NP))
                                <a href="https://novaposhta.ua/{{ App::getLocale() }}/tracking/?cargo_number={{ $order->ttn }}"
                                   target="_blank"
                                   rel="nofollow" class="main-btn--green">
                                    {{ __('frontend/profile/index.track_order') }}
                                </a>
                            @elseif($order->delivery->type->is(DeliveryType::COURIER_NP))
                                <a href="https://novaposhta.ua/{{ App::getLocale() }}/tracking/?cargo_number={{ $order->ttn }}"
                                   target="_blank"
                                   rel="nofollow" class="main-btn--green">
                                    {{ __('frontend/profile/index.track_order') }}
                                </a>
                            @endif
                        @endif
                    </td>
                </tr>
                @if($order->products->count() > 1)
                    @foreach($order->products as $product)
                        <tr class="more_open more_open_{{$count}}">
                            <td data-label="{{ __('frontend/profile/index.date') }}" class="order__data">
                                @include('frontend.elements.order.image_block', ['product' => $product])
                            </td>
                            <td data-label="{{ __('frontend/profile/index.product') }}" class="order__text">
                                <a href="{{ $product->alias }}">{{ $product->name }}</a>
                            </td>
                            <td data-label="{{ __('frontend/profile/index.sku') }}" class="order__vendor-code">
                                {{ $product->sku }}
                                @if($order->products->count() === 1)
                                    {{ $order->products->first()->sku }}
                                @endif
                            </td>
                            <td data-label="{{ __('frontend/profile/index.price') }}" class="order__price">
                                {{ $product->format_total_unit_price }}
                                @lang('frontend/product/index.uah')
                                @if($order->products->count() === 1)
                                    {{ $order->products->first()->format_total_unit_price }}
                                    @lang('frontend/product/index.uah')
                                @endif
                            </td>
                            <td data-label="{{ __('frontend/profile/index.quantity') }}" class="order__sum">
                                {{ $product->pivot->qty }}
                                @if($order->products->count() === 1)
                                    {{ $order->products->first()->pivot->qty }}
                                @endif
                            </td>
                            <td data-label="{{ __('frontend/profile/index.cost') }}" class="order__value">
                            </td>
                            <td data-label="{{ __('frontend/profile/index.status') }}" class="order__status paid">
                            </td>
                            <td data-label="" class="order__track"></td>
                        </tr>
                    @endforeach
                @endif
                @php
                    $count++
                @endphp
            @endforeach
            </tbody>
        </table>
    </div>
@endif