@extends('frontend.mails.layout')

@section('content')
    <tr style="">
        <td bgcolor="#ffffff" width="600" style="line-height:0; font-size:0; position: relative;">
            <table align="left" cellpadding="0" cellspacing="0"
                   style="border-collapse:collapse;vertical-align:top; position: relative; background-image: url(&quot;images/bg-images/planet_bg.png&quot;); background-position: top right; background-repeat: no-repeat; background-size: 70%;">
                <!--img(src='images/bg-images/planet_bg.png' style='position: absolute; top: 10px; right: 0; z-index: 0;')-->
                <tbody style="position: relative; z-index: 10;">
                <tr align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse;vertical-align:top;"></tr>
                <tr height="30" style="line-height:0; font-size:0;">
                    <td></td>
                </tr>
                <tr>
                    <td width="45"></td>
                    <td valign="top">
                        <p style="font-family: Arial; font-size: 24px; line-height: 137.99%; color: #132437; font-weight: 600;">@lang('mails.reset_password')</p>
                        <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #5C6A7F;">@lang('mails.respected')<span> {{ $client->name }}</span>,
                            @lang('mails.you_made_request')
                            <a href="{{ config('app.url') }}" style="color: #222C67 !important; display: inline-block; margin-left: 2px; font-family: Arial; font-size: 14px; line-height: 19px;">{{ config('app.url') }}</a>.
                            @lang('mails.to_get_new_pass_press_btn'): </p>
                        <p style="font-size: 16px; line-height: 20px; color: #787878;">
                            <a href="{{ url(config('app.url'.':'.'app.port').route('password.reset', [$token ."?email=".$client->email], false)) }}"
                               style="background: #55CE8C; display: inline-block; padding: 15px 35px; color: #ffffff; text-decoration: none; text-transform: uppercase; font-weight: 700;">@lang('mails.restore')</a>
                        </p>
                    </td>
                    <td width="45"></td>
                </tr>
                <tr height="50" style="line-height:0; font-size:0;">
                    <td colspan="5"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection