@extends('frontend.mails.layout')

@section('content')
    <table width="600" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
        <tr>
            <td height="48" style="font-size:48px; line-height:48px;">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" valign="top">
                <table width="496" cellpadding="0" cellspacing="0" border="0" class="container">
                    <tr>
                        <td align="left" valign="top" style="font-size:20px;line-height:28px;color: #132437;font-weight:600;">
                            @lang('mails.reset_password')
                            <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #5C6A7F;">@lang('mails.respected')<span>{{ $client->name }}</span>,
                                @lang('mails.you_made_request')
                                <a href="{{ config('app.url') }}" style="color: #222C67 !important; display: inline-block; margin-left: 2px; font-family: Arial; font-size: 14px; line-height: 19px;">{{ config('app.url') }}</a>.
                                @lang('mails.to_get_new_pass_press_btn'): </p>
                            <p style="font-size: 16px; line-height: 20px; color: #787878;">
                        </td>
                    </tr>
                    <tr>
                        <td height="12" style="font-size:12px; line-height:12px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="color: #455A64;">
                            @lang('frontend/app.dear', [
                                'name' => $client->name,
                            ])
                            <br>
                            @lang('frontend/app.you_made_a_request_for_a_forgotten_password_on_the_site')
                            <a href="{{ url('/') }}" target="_blank" style="color:#079DE2; text-decoration:none;">
                                {{ config('app.name') }}
                            </a>.
                        </td>
                    </tr>
                    <tr>
                        <td height="12" style="font-size:12px; line-height:12px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" style="color: #455A64;">
                            @lang('frontend/app.to_reset_password_click_on_the_button')
                        </td>
                    </tr>
                    <tr>
                        <td height="42" style="font-size:42px; line-height:42px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">
                            <table height="44" cellpadding="0" cellspacing="0" border="0" bgcolor="#079DE2" style="border-radius:3px;box-shadow: 0px 2px 4px rgba(19, 36, 55, 0.22);">
                                <tr>
                                    <td align="center" valign="middle" height="40" style="font-family: Arial, sans-serif; font-size:14px; font-weight:600;">
                                        <a href="{{ $route }}" target="_blank" style="font-family: Arial, sans-serif; color:#ffffff; display: inline-block; text-decoration: none; line-height:44px; font-weight:600;letter-spacing: 0.04em;text-transform: uppercase;padding: 0 15px;">
                                            @lang('auth.reset')
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height="48" style="font-size:48px; line-height:48px;">&nbsp;</td>
        </tr>
    </table>
@endsection
