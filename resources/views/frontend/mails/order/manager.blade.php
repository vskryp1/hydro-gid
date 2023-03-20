@extends('frontend.mails.layout')

@section('content')
    <tr>
        <td bgcolor="#ffffff" width="600" style="line-height:0; font-size:0;">
            <table align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse;vertical-align:top;">
                <tbody>
                <tr align="left" cellpadding="0" cellspacing="0"
                    style="border-collapse:collapse;vertical-align:top;"></tr>
                <tr height="30" style="line-height:0; font-size:0;">
                    <td></td>
                </tr>
                <tr>
                    <td width="45"></td>
                    <td valign="top">
                        <h3 style="font-family: Arial; font-size: 20px; line-height: 28px; color: #333333; margin: 0;">@lang('mails.order_info')</h3>
                        <p style="margin: 15px 0;"><a
                                    style="text-decoration: none; padding: 5px 15px; background-color: #FF9B00; display: inline-block; font-family: Arial; font-size: 20px; line-height: 23px; align-items: center; color: #21283D;"
                                    href="{{ route('backend.orders.edit', $order) }}">#{{ $order->unique_id }}</a></p>
                        <p style="font-family: Arial; font-size: 20px; line-height: 28px; color: #21283D;">{{ $client->first_name }} {{ $client->last_name }}</p>
                    </td>
                    <td width="45"></td>
                </tr>
                <tr>
                    <td width="45"></td>
                    <td valign="top">
                        <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #21283D; letter-spacing: 0.01em;">
                            <a style="font-family: Arial; font-size: 14px; line-height: 19px; color: #21283D; text-decoration: none;"
                               href="tel:+38{{ $client->phone }}">{{ $client->phone }}</a>
                            <br></p>
                        <p style="font-size: 16px; line-height: 26px; color: #21283D; padding: 5px 0;">
                            <strong>@lang('backend/profile/index.email'):</strong>
                            <a style="color: #222C67; text-decoration: none; display: inline-block; background-color: #F7F7F7; padding: 10px 20px; font-weight: 700;"
                               href="mailto:{{ $client->email }}">{{ $client->email }}</a></p>
                        <p style="font-size: 16px; line-height: 26px; color: #21283D; padding: 5px 0;">
                            <strong>@lang('mails.delivery'):</strong>
                            <span style="margin-left: 5px;">
                                {{ $warehouse }}
                                {{ $order->delivery->name }} {{ $order->address ? $order->address->formatted : '' }}
                            </span>
                        </p>
                    </td>
                    <td width="45"></td>
                </tr>
                <tr height="32" style="line-height:0; font-size:0;">
                    <td></td>
                </tr>
                </tbody>
            </table>
            @include('frontend.mails.order.include.order_products')
        </td>
    </tr>
@endsection