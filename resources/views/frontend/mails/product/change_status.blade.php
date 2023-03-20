@extends('frontend.mails.layout')

@section('content')
    <tr>
        <td bgcolor="#ffffff" width="600" style="line-height:0; font-size:0;">
            <table align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse;vertical-align:top;">
                <tbody>
                    <tr align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse;vertical-align:top;"></tr>
                    <tr height="30" style="line-height:0; font-size:0;">
                        <td></td>
                    </tr>
                    <tr>
                        <td width="45"></td>
                        <td valign="top">
                            <h3 style="font-family: Arial; font-size: 20px; line-height: 28px; color: #333333; margin: 0;">@lang('mails.hello') {{ $user->name }}!</h3>
                            <p style="margin: 15px 0;">
                                <span style="font-family: Arial; font-size: 16px; line-height: 18px; letter-spacing: 0.15px; color: #21283D; margin-right: 10px;">
                                    @lang('mails.product_status_changed', ['name' => $product->name, 'availability' => $product->availability->description])
                                </span>
                            </p>
                        </td>
                        <td width="45"></td>
                    </tr>
                </tbody>
            </table>
            @include('frontend.mails.product.index')
        </td>
    </tr>
@endsection