<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base"
               role="tab"
               aria-controls="home" aria-selected="false">
                @lang('backend.base') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="client-tab" data-toggle="tab" href="#client" data-tab="#client"
               role="tab"
               aria-controls="profile" aria-selected="true">
                @lang('backend.clients') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="products-tab" data-toggle="tab" href="#products" data-tab="#products"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.products') </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base" role="tabpanel" aria-labelledby="base-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @isset($order)
                        <div class="form-group">
                            <label>@lang('backend.order_id')</label>
                            {!! Form::text('unique_id', null, ['class' => 'form-control', 'readonly' => isset($order)])!!}
                        </div>
                    @endisset
                    @can('list all orders')
                        <div class="form-group">
                            <label>@lang('backend.manager')</label>
                            {!! Form::select('user_id', $managers->prepend('-', ''), null, ['class' => 'form-control'])!!}
                        </div>
                    @endcan
                    <div class="form-group">
                        <label>@lang('backend.status')</label>
                        {!! Form::select('order_status_id', $order_statuses, null, ['class' => 'form-control js_order_status'])!!}
                        @isset($order)
                            <small>{!! Form::checkbox('notification', 1, false, ['class' => 'flat js_status_notification']) !!}
                                @lang('backend.order_status_change_notif')
                            </small>
                        @endisset
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.ttn_number')</label>
                        {!! Form::text('ttn', null, ['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.delivery_method')</label>
                        {{ Form::select(
                             'delivery_id',
                             $deliveries->pluck('name', 'id'),
                             null,
                             ['class' => 'form-control js_delivery ' . (!isset($order) ? 'js_order_create' : '')],
                             $deliveryOptions ?? []
                         ) }}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.places')</label>
                        {!! Form::hidden('place_api_id', '') !!}
                        {!! Form::select('place_api_id', $delivery_places, null, ['class' => 'form-control js_np_cities js-select-places', 'data-delivery' => $order->delivery->id??key(reset($deliveries))])!!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.warehouse')</label>
                        {!! Form::hidden('warehouse_id', '') !!}
                        {!! Form::select(
                            'warehouse_id',
                            $warehouses, isset($order) ? $order->warehouse_id : null,
                            ['class' => 'form-control js-select-np-warehouses']
                        )!!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.payment_method')</label>
                        {!! Form::select('payment_id', $payments, null, ['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.locale')</label>
                        {!! Form::select('locale', ShopHelper::languages('id', true), null, ['class' => 'form-control locales'])!!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.comment')</label>
                        {!! Form::textarea('comment', null, ['class' => 'form-control'])!!}
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="client" role="tabpanel" aria-labelledby="client-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="col-md-12 col-sm-6 col-xs-12 form-group">
                        <lable>@lang('backend.select_exist_client')</lable>
                        <input type="hidden" name="client_id" value={{$order->client->id??''}}>
                        <input type="hidden" name="temp_client_id" value={{$order->temp_client_id??''}}>
                        {!! Form::select('client_id', (isset($order->client) ? [$order->client->id => $order->client->name] : []), null, ['class' => 'form-control js_clients_search'])!!}
                    </div>
                    <div id="exist-address" class="col-md-12 col-sm-6 col-xs-12 form-group">
                        <input type="hidden" name="address_id" value={{$order->address_id??''}}>
                        <lable>@lang('backend.address')</lable>
                        @if(isset($order->client->addresses) && count($order->client->addresses) > 1)
                            <select name="address_id" id="" class="form-control js_addresses">
                                @foreach($order->client->addresses as $address)
                                    <option value="{{ $address->id }}" @if($order->address_id == $address->id) selected
                                            @endif
                                            data-address-place-name="{{ $address->delivery_place ? $address->delivery_place->name : null }}"
                                            data-address-place-id="{{ $address->delivery_place ? $address->delivery_place->api_id : null }}"
                                            data-address-street="{{ $address->street }}"
                                            data-address-house="{{ $address->house }}">{{ $address->formatted }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    @if(isset($order) && $order->client instanceof \App\Models\Client\Client)
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::text('name', $order->client->name??'',
                            ['class' => 'form-control has-feedback-left', 'id' => 'name',
                             'placeholder' => __('backend.name'), 'required' => 'required']) }}
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::email('email', $order->client->email??'',
                            ['class' => 'form-control has-feedback-left', 'id' => 'email',
                             'placeholder' => __('backend.email')]) }}
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::text('phone', $order->client->phone??'',
                            ['class' => 'form-control has-feedback-left', 'id' => 'contact-number',
                             'placeholder' => __('backend.phone')]) }}
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            <div class="row">
                                <div class="col-xs-1">
                                    <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                @isset($order->address)
                                    <div class="col-xs-11">
                                        {{ Form::select(
                                           'address_place_id',
                                           $order->address->delivery_place ? $order->address->delivery_place->delivery_option: [],
                                           $order->address->delivery_place->api_id ?? '',
                                           [
                                             'class'           => 'form-control js-select-places',
                                             'data-delivery'   => $order->delivery->id??key(reset($deliveries)),
                                             'id'              => 'city',
                                             'placeholder'     => __('backend.city')
                                            ])
                                        }}
                                    </div>
                                @endisset
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::text('street', $order->address->street ?? $order->client->main_address->street ?? '',
                            ['class' => 'form-control has-feedback-left', 'id' => 'street',
                             'placeholder' => __('backend.street')]) }}
                            <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::text('house', $order->address->house ?? $order->client->main_address->house ?? '',
                            ['class' => 'form-control has-feedback-left', 'id' => 'house',
                             'placeholder' => __('backend.house')]) }}
                            <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        @if($order->client->edrpou)
                            <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::text('edrpou', $order->client->edrpou,
                                ['class' => 'form-control has-feedback-left', 'id' => 'edrpou',
                                 'placeholder' => __('backend.edrpou')]) }}
                                <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::text('company_name', $order->client->company_name,
                                ['class' => 'form-control has-feedback-left', 'id' => 'company_name',
                                 'placeholder' => __('backend.company_name')]) }}
                                <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        @endif
                    @elseif(isset($order) && $order->tempClients)
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::text('first_name', $order->tempClients->first_name ?? '',
                            ['class' => 'form-control has-feedback-left', 'id' => 'name',
                             'placeholder' => __('backend.first_name'), 'required' => 'required']) }}
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::text('last_name', $order->tempClients->last_name ?? '',
                            ['class' => 'form-control has-feedback-left', 'id' => 'last_name',
                             'placeholder' => __('backend.last_name'), 'required' => 'required']) }}
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::email('email', $order->tempClients->email ?? '',
                            ['class' => 'form-control has-feedback-left', 'id' => 'email',
                             'placeholder' => __('backend.email')]) }}
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::text('phone', $order->tempClients->phone ?? '',
                            ['class' => 'form-control has-feedback-left', 'id' => 'contact-number',
                             'placeholder' => __('backend.phone')]) }}
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            <div class="row">
                                <div class="col-xs-1">
                                    <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                @isset($order->address)
                                    <div class="col-xs-11">
                                        {{ Form::select(
                                           'address_place_id',
                                           $order->address->delivery_place ? $order->address->delivery_place->delivery_option: [],
                                           $order->address->delivery_place->api_id ?? '',
                                           [
                                             'class'           => 'form-control js-select-places',
                                             'data-delivery'   => $order->delivery->id??key(reset($deliveries)),
                                             'id'              => 'city',
                                             'placeholder'     => __('backend.city')
                                            ])
                                        }}
                                    </div>
                                @endisset
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::text('street', $order->address->street ?? '',
                            ['class' => 'form-control has-feedback-left', 'id' => 'street',
                             'placeholder' => __('backend.street')]) }}
                            <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                            {{ Form::text('house', $order->address->house ?? '',
                            ['class' => 'form-control has-feedback-left', 'id' => 'house',
                             'placeholder' => __('backend.house')]) }}
                            <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        @if($order->tempClients->edrpou)
                            <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::text('edrpou', $order->tempClients->edrpou,
                                ['class' => 'form-control has-feedback-left', 'id' => 'edrpou',
                                 'placeholder' => __('backend.edrpou')]) }}
                                <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::text('company_name', $order->tempClients->company_name,
                                ['class' => 'form-control has-feedback-left', 'id' => 'company_name',
                                 'placeholder' => __('backend.company_name')]) }}
                                <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane" id="products" role="tabpanel" aria-labelledby="products-tab">
            <div class="row">
                <div class="table-responsive" id="products">
                    <table class="table table-striped">
                        <thead>
                        <tr role="row">
                            <th width="30px"></th>
                            <th width="30px">@lang('backend.image')</th>
                            <th>@lang('backend.title')</th>
                            <th width="250px">@lang('backend.options')</th>
                            <th width="130px">@lang('backend.availability')</th>
                            <th width="130px">@lang('backend.warranty_price')</th>
                            <th width="130px">@lang('backend.warranty_amount')</th>
                            <th width="130px">@lang('backend.price')</th>
                            <th width="130px">@lang('backend.quantity')</th>
                            <th width="150px">@lang('backend.sub_total')</th>
                        </tr>
                        <tr class="text-center js_no_item">
                            <td colspan="7" class="bg-warning">
                                <h4>@lang('backend.no_items')</h4>
                            </td>
                        </tr>
                        </thead>
                        <tbody class="product-list">
                        @isset($order->products)
                            @foreach($order->products as $product)
                                @include('backend.orders.product', [
                                'id' => $product->id,
                                'cover' => $product->cover->getUrl('prod_md'),
                                'format_name' => $product->format_name,
                                'options' => (config('app.group_products', false) ? $product->modification_name : json_decode($product->pivot->options, true)),
                                'pivot_options' => json_decode($product->pivot->options, true),
                                'price' => $product->pivot->price??'',
                                'qty' => $product->pivot->qty,
                                ])
                            @endforeach
                        @endisset
                        @foreach(old('products', []) as $product)
                            @include('backend.orders.product')
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="8">
                                <div class="form-group">
                                    {!! Form::select('query', [], null, ['class' => 'form-control js_products_search has-feedback-left'])!!}
                                </div>

                            </td>
                        </tr>
                        <tr class="text-right">
                            <td colspan="9" style="vertical-align:bottom">
                                <h4>@lang('backend.discount')</h4>
                            </td>
                            <td>
                                <label for="inputIsPercentage" class="control-label">
                                    @lang('backend/profile/index.is_percentage')
                                </label><br>
                                {!! Form::hidden('is_percentage', 0) !!}
                                {!! Form::checkbox('is_percentage', 1, $order->is_percentage ?? old('is_percentage'), [
                                    'id'    => 'inputIsPercentage',
                                    'class' => 'js-switch',
                                ]) !!}
                                {{ Form::number('discount', isset($order->discount) ? ShopHelper::price_format($order->discount, true) : 0,
                                    ['class' => 'form-control total-price-field js_order_discount',
                                    'data-order-discount-percentage' => $order->is_percentage ?? '',
                                    'step' => 0.01, 'min' => 0,
                                   'placeholder' => 'Discount', 'required' => 'required']) }}
                            </td>
                        </tr>
                        <tr class="text-right">
                            <td colspan="9" style="vertical-align:bottom">
                                <h4>@lang('backend.delivery'):</h4>
                            </td>
                            <td>
                                {{ Form::number('delivery_price', isset($order) ? ShopHelper::price_format($order->delivery_price, true) : 0,
                                ['class' => 'form-control total-price-field js_order_delivery',
                                'step' => 0.01, 'min' => 0,
                                'placeholder' => __('backend.delivery_price')]) }}
                            </td>
                        </tr>
                        <tr class="text-right">
                            <td colspan="9" style="vertical-align:bottom"><h4>@lang('backend.total'):</h4></td>
                            <td>
                                <div class="form-group pull-right order-sum">
                                    <label class="control-label col-md-7 col-sm-7 col-xs-12">
                                        <span class="js_order_sum total-price"></span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-right">
                            <td colspan="9" style="vertical-align:bottom"><h4>@lang('backend.currency'):</h4></td>
                            <td>
                                <div class="form-group pull-right">
                                    @if(isset($order))
                                        {{ Form::hidden('currency_id') }}
                                        {!! Form::select('currency_id', $currencies_list, null, ['class' => 'form-control js_currency', 'disabled'])!!}
                                    @else
                                        {!! Form::select('currency_id', $currencies_list, null, ['class' => 'form-control js_currency'])!!}
                                    @endif
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.elements.save_buttons', ['back_link' => route('backend.orders.index'), 'export_link'  => isset($order) ? route('backend.orders.export',['order'=> $order]) : null])