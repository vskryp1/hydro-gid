<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr role="row">
            <th>@lang('backend.order_id')</th>
            <th width="90px">@lang('backend.date')</th>
            <th>@lang('backend.admin')</th>
            <th>@lang('backend.client')</th>
            <th width="30%">@lang('backend.products')</th>
            <th>@lang('backend.status')</th>
            <th>@lang('backend.total_price')</th>
            <th>@lang('backend.currency')</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr role="row">
                <td>{{$order->unique_id}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->user->name??'-'}}</td>
                <td>{{$order->client->name??$order->tempClients->name}}</td>
                <td>
                    <a class="collapsed" data-toggle="collapse"
                       href="#collapse{{$order->unique_id}}">@lang('backend.show') / @lang('backend.hide')</a>
                    <div id="collapse{{$order->unique_id}}" class="panel-collapse collapse">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>@lang('backend.sku')</th>
                                <th>@lang('backend.name')</th>
                                <th>@lang('backend.price')</th>
                                <th>@lang('backend.quantity')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td>{{$product->sku}}</td>
                                    <th scope="row">{{$product->name}}</th>
                                    <td>{{number_format($product->pivot->price, 2)}}</td>
                                    <td>{{$product->pivot->qty}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </td>
                <td>{{$order->order_status->name??'-'}}</td>
                <td>{{ShopHelper::price_format($order->getTotalPrice())}}</td>
                <td>{{$order->currency->full_name}}</td>
                <td>
                    @include('backend.elements.edit_buttons', [
                        'edit_link'    => route('backend.orders.edit',['order'=> $order]),
                        'destroy_link' => route('backend.orders.destroy', $order->id),
                    ])
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="bg-warning">
                    <h3 class="text-center">
                        @lang('backend.nothing_found')
                    </h3>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $orders->links('backend.elements.pagination') }}
</div>