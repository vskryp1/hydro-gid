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
                        <h3 style="font-family: Arial; font-size: 20px; line-height: 28px; color: #333333; margin: 0;">@lang('mails.hello')
                            !</h3>
                        <p style="margin: 15px 0;">
                            <span style="font-family: Arial; font-size: 16px; line-height: 18px; letter-spacing: 0.15px; color: #21283D; margin-right: 10px;">
                                @lang('mails.order_id'):</span>
                            <a style="text-decoration: none; padding: 5px 15px; background-color: #FF9B00; display: inline-block; font-family: Arial; font-size: 20px; line-height: 23px; align-items: center; color: #21283D;">
                                #{{ $orderBuyClick->unique_id }}
                            </a>
                        </p>
                    </td>
                    <td width="45"></td>
                </tr>
                <tr>
                    <td width="45"></td>
                    <td valign="top">
                        <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #21283D; letter-spacing: 0.01em;">
                            <br><span style="font-family: Arial; font-size: 16px; line-height: 18px; letter-spacing: 0.15px; color: #21283D; margin-right: 10px;">
                                @lang('mails.phone'):</span>
                            <a style="font-family: Arial; font-size: 14px; line-height: 19px; color: #21283D; text-decoration: none;">{{ $orderBuyClick->phone }}</a>
                        </p>
                        <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #21283D; letter-spacing: 0.01em;">
                            <br><span style="font-family: Arial; font-size: 16px; line-height: 18px; letter-spacing: 0.15px; color: #21283D; margin-right: 10px;">
                                @lang('mails.name'):</span>
                            <a style="font-family: Arial; font-size: 14px; line-height: 19px; color: #21283D; text-decoration: none;">{{ $orderBuyClick->name }}</a>
                        </p>
                        <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #21283D; letter-spacing: 0.01em;">
                            <br><span style="font-family: Arial; font-size: 16px; line-height: 18px; letter-spacing: 0.15px; color: #21283D; margin-right: 10px;">
                                @lang('mails.product'):</span>
                            <a style="font-family: Arial; font-size: 14px; line-height: 19px; color: #21283D; text-decoration: none;"
                               href="{{ $orderBuyClick->product->alias }}">{{ $orderBuyClick->product->name }}</a>
                            <br>
                        </p>
                    </td>
                    <td width="45"></td>
                </tr>
                <tr height="32" style="line-height:0; font-size:0;">
                    <td></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection