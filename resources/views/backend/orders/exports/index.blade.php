<table style="width:100%;border:2px dashed #ccc;color:#111;font-size:20px;">
    <tbody>
    @isset($order->user)
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td align="left"><b>@lang('backend.export_manager')</b></td>
            <td align="left" colspan="5"></td>
        </tr>
        <tr>
            <td align="left"><b>@lang('backend.export_user_full_name')</b>:</td>
            <td align="left" colspan="5">{{ $order->user->format_name }}</td>
        </tr>
        <tr>
            <td align="left"><b>@lang('backend.export_user_phone')</b>:</td>
            <td align="left" colspan="5">{{ '+' . $order->user->phone }}</td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>
    @else
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>
    @endisset
    <tr>
        <td align="center" colspan="6">
            <b>@lang('backend.export_order_title', ['number' => $order->unique_id])</b>
        </td>
    </tr>
    <tr>
        <td colspan="6"></td>
    </tr>
    @isset($order->client)
        <tr>
            <td align="left"><b>@lang('backend.export_buyer')</b></td>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td align="left"><b>@lang('backend.export_buyer_full_name')</b>:</td>
            <td colspan="5">{{ $order->client->format_name }}</td>
        </tr>
        <tr>
            <td align="left"><b>@lang('backend.export_buyer_address')</b>:</td>
            <td colspan="5">{{ $order->client->addresses->pluck('format_address')->first() }}</td>
        </tr>
        <tr>
            <td align="left"><b>@lang('backend.export_buyer_phone')</b>:</td>
            <td colspan="5">{{ '+' . $order->client->phone }}</td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>
    @else
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>
    @endisset
    <tr>
        <td align="center" colspan="6"><b>@lang('backend.export_order_contains')</b></td>
    </tr>
    <tr>
        <th align="center">#</th>
        <th align="center">@lang('backend.export_order_product_sku')</th>
        <th align="center">@lang('backend.export_order_product_name')</th>
        <th align="center">@lang('backend.export_order_product_qty')</th>
        <th align="center">@lang('backend.export_order_product_price')</th>
        <th align="center">@lang('backend.export_order_product_total')</th>
    </tr>
    @foreach($products as $i => $product)
        <tr align="center">
            <td align="center">{{ ++$i }}</td>
            <td align="center">{{ $product['sku'] }}</td>
            <td align="center">{{ $product['name'] }}</td>
            <td align="center">{{ $product['quantity'] }}</td>
            <td align="center">{{ $product['price'] }}</td>
            <td align="center">{{ $product['total'] }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="6"></td>
    </tr>
    @isset($summary['discount'], $summary['promocode'])
        <tr>
            <td colspan="4"></td>
            <td align="right">@lang('backend.export_order_promocode_sale', ['promocode' => $summary['promocode']]):</td>
            <td align="center">{{ $summary['discount'] }}</td>
        </tr>
    @else
        <tr>
            <td colspan="6"></td>
        </tr>
    @endisset
    <tr>
        <td colspan="4"></td>
        <td align="right">@lang('backend.export_order_delivery_place'):</td>
        <td align="center">{{ $summary['deliveryPlace'] }}</td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td align="right">@lang('backend.export_order_total_price'):</td>
        <td align="center">{{ $summary['totalPrice'] }}</td>
    </tr>
    <tr>
        <td colspan="6"></td>
    </tr>
    <tr>
        <td align="left">@lang('backend.export_order_provider'):</td>
        <td align="left" colspan="3">{{ url('/') }}</td>
        <td align="right">@lang('backend.export_date'):</td>
        <td align="center">{{ date('Y-m-d H:i:s') }}</td>
    </tr>
    </tbody>
</table>