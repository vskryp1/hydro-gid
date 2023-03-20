<table style="background: #fefefe; border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
    <tbody>
    <tr style="width: 90%; border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; display: block; margin: 0 auto; margin-bottom: 50px; overflow: hidden;"
        align="center">
        <td style="display: block; width: 100%;">
            <table style="margin: 0 auto; background: #fefefe; border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
                <tbody>
                @foreach($order->products as $product)
                    <tr height="25" style="line-height:0;font-size:0; width: 100%; border-top: 1px solid #CFD2E6;">
                        <td colspan="6"></td>
                    </tr>
                    <tr style="font-size:14px;line-height:1.5; width: 100%;">
                        <td colspan="2">
                            <table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top; width: 120px;"><a href="{{ $product->alias }}" style="width: 100%;">
                                            <img style="margin: 0 auto; max-height: 80px; width: auto; display: block;" src="{{ $product->cover->getUrl('prod_md') }}" alt='{{ $product->name }}'></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="5">
                            <table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
                                <tbody>
                                <tr>
                                    <td style="padding:0 10px;text-align:left;vertical-align: middle; font-size: 18px; line-height:25px; color: #515151;"><a href="{{ $product->alias }}"                                                                                                                                                            style="text-decoration: none;">
                                            <h4 style="font-family: Arial; font-size: 14px; line-height: 20px; letter-spacing: 0.1px; color: #21283D; font-weight: 600; text-decoration: none;">
                                                {{ $product->name }}
                                                {{ $product->getWarrantyText() }}
                                            </h4>
                                        </a></td>
                                    <td style="font-family: Arial; font-size: 14px; line-height: 20px; letter-spacing: 0.1px; color: #21283D; font-weight: 600; text-decoration: none;">
                                        <span>{{ $product->pivot->qty }}</span><span>@lang('mails.amount')</span>
                                    </td>
                                    <td width="45"></td>
                                </tr>
                                </tbody>
                            </table>
                            <table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
                                <tbody>
                                <tr>
                                    <td style="padding:0 10px;text-align:left;vertical-align: middle; font-family: Arial; font-size: 20px; line-height: 24px; letter-spacing: 0.15px; color: #222C67; font-weight: 700;">
                                        <span style="margin-right: 5px; display: inline-block;">{{ $product->format_total_unit_price }}</span>
                                        <span style="font-family: Arial; font-size: 14px; line-height: 20px; letter-spacing: 0.25px; color: #222C67; font-weight: 300;">@lang('frontend/product/index.uah')</span>
                                    </td>
                                    <td width="45"></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr height="25" style="line-height:0;font-size:0; width: 100%; border-bottom: 1px solid #CFD2E6;">
                        <td colspan="6"></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <table style="padding: 15px 0; margin: 0 auto; background-color: #ffffff; border-collapse: collapse; border-spacing: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
                <tbody>
                <tr height="25" style="line-height:0;font-size:0">
                    <td></td>
                </tr>
                <tr style="font-size:12px;line-height:1.5; margin-bottom: 10px;">
                    <td width="45" style="width: 45px;"></td>
                    <td colspan="1"
                        style="padding:0 10px;text-align:left;vertical-align: middle; font-family: Arial; font-size: 16px; line-height: 24px; letter-spacing: 0.44px; color: #21283D; font-weight: 300;">
                                    <span>
                                        <span>{{ $order->products->sum('pivot.qty') }}</span>
                                        @lang(trans_choice('frontend/checkout/index.products_on_sum', $order->products->sum('pivot.qty')))
                                    </span>
                    </td>
                    <td colspan="3"
                        style="padding:0 10px;text-align:right;vertical-align: middle; font-weight: 700; font-family: Arial; font-size: 20px; line-height: 24px; letter-spacing: 0.15px; color: #5C6A7F; font-weight: 700;">

                        <span style="margin-right: 5px; display: inline-block;">{{ $order->formatted_products_price }}</span>
                        <span style="font-family: Arial; font-size: 14px; line-height: 20px; letter-spacing: 0.25px; color: #5C6A7F; font-weight: 300;">{{ $order->first()->currency->sign }}</span></td>
                    <td width="45"></td>
                </tr>
                <tr height="10" style="line-height:0;font-size:0">
                    <td></td>
                </tr>
                @if($order->discount > 0)
                    <tr style="font-size:12px;line-height:1.5; margin-bottom: 10px;">
                        <td width="45" style="width: 45px;"></td>
                        <td colspan="1"
                            style="padding:0 10px;text-align:left;vertical-align: middle; font-family: Arial; font-size: 16px; line-height: 24px; letter-spacing: 0.44px; color: #21283D; font-weight: 300;">
                            <span>@lang('frontend/checkout/index.discount')</span>
                        </td>
                            <td colspan="3"
                                style="padding:0 10px;text-align:right;vertical-align: middle; font-weight: 700; font-family: Arial; font-size: 20px; line-height: 24px; letter-spacing: 0.15px; color: #5C6A7F; font-weight: 700;">
                                <span style="margin-right: 5px; display: inline-block;">{{ $order->formatted_discount }}</span>
                                <span style="font-family: Arial; font-size: 14px; line-height: 20px; letter-spacing: 0.25px; color: #5C6A7F; font-weight: 300;">{{ $order->first()->currency->sign }}</span>
                            </td>
                            <td width="45"></td>
                    </tr>
                    <tr height="10" style="line-height:0;font-size:0">
                        <td></td>
                    </tr>
                @endif
                @if($order->delivery->format_price > 0)
                    <tr style="font-size:12px;line-height:1.5; margin-bottom: 10px;">
                        <td width="45" style="width: 45px;"></td>
{{--                        <td colspan="1"--}}
{{--                            style="padding:0 10px;text-align:left;vertical-align: middle; font-family: Arial; font-size: 16px; line-height: 24px; letter-spacing: 0.44px; color: #21283D; font-weight: 300;">--}}
{{--                            <span>@lang('frontend/checkout/index.delivery_cost')</span>--}}
{{--                        </td>--}}
{{--                        <td colspan="3"--}}
{{--                            style="padding:0 10px;text-align:right;vertical-align: middle; font-weight: 700; font-family: Arial; font-size: 20px; line-height: 24px; letter-spacing: 0.15px; color: #5C6A7F; font-weight: 700;">--}}
{{--                            <span style="margin-right: 5px; display: inline-block;">{{ $order->delivery->format_price }}</span><span--}}
{{--                                    style="font-family: Arial; font-size: 14px; line-height: 20px; letter-spacing: 0.25px; color: #5C6A7F; font-weight: 300;">{{ $order->first()->currency->sign }}</span></td>--}}
{{--                        <td width="45"></td>--}}
                    </tr>
                    <tr height="10" style="line-height:0;font-size:0">
                        <td></td>
                    </tr>
                @endif
                <tr style="font-size:12px;line-height:1.5; margin-bottom: 10px;">
                    <td width="45" style="width: 45px;"></td>
                    <td colspan="1"
                        style="padding:0 10px;text-align:left;vertical-align: middle; font-family: Arial; font-size: 16px; line-height: 24px; letter-spacing: 0.44px; color: #21283D; font-weight: 300;">
                        <span>@lang('mails.type_payment')</span>
                    </td>
                    <td colspan="3"
                        style="text-align:right; padding:0 10px; vertical-align: middle; font-weight: 700; font-family: Arial; font-size: 20px; line-height: 24px; letter-spacing: 0.15px; color: #5C6A7F; font-weight: 700;">
                        <span style="margin-right: 5px; display: inline-block;">{{ $order->payment->name }}</span></td>
                    <td width="45"></td>
                </tr>
                <tr height="25" style="line-height:0;font-size:0; width: 100%; border-bottom: 1px solid #CFD2E6;">
                    <td colspan="6"></td>
                </tr>
                </tbody>
            </table>
            <table style="padding: 15px 0; margin: 0 auto; background-color: #ffffff; border-collapse: collapse; border-spacing: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
                <tbody>
                <tr height="25" style="line-height:0;font-size:0">
                    <td></td>
                </tr>
                <tr style="font-size:12px;line-height:1.5; margin-bottom: 10px;">
                    <td width="45" style="width: 45px;"></td>
                    <td colspan="1"
                        style="padding:0 10px;text-align:left;vertical-align: middle; font-family: Arial; font-size: 20px; line-height: 24px; letter-spacing: 0.15px; color: #28347C; font-weight: 600;">
                        <span>@lang('mails.total')</span>
                    </td>
                    <td colspan="3"
                        style="padding:0 10px;text-align:right;vertical-align: middle; font-weight: 700; font-family: Arial; font-size: 24px; line-height: 28px; letter-spacing: 0.15px; color: #222C67; font-weight: 700;">
                        <span style="margin-right: 5px; display: inline-block;">{{ $order->formatted_total_price }}</span><span
                                style="font-family: Arial; font-size: 14px; line-height: 20px; letter-spacing: 0.25px; color: #222C67; font-weight: 300;">{{ $order->first()->currency->sign }}</span></td>
                    <td width="45"></td>
                </tr>
                <tr height="25" style="line-height:0;font-size:0">
                    <td></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>