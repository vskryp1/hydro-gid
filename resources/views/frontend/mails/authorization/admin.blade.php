@extends('frontend.mails.layout')

@section('content')
    <tr style="">
        <td bgcolor="#ffffff" width="600" style="line-height:0; font-size:0; position: relative;">
            <table align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse;vertical-align:top;">
                <tbody style="position: relative; z-index: 10;">
                <tr align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse;vertical-align:top;"></tr>
                <tr height="30" style="line-height:0; font-size:0;">
                    <td></td>
                </tr>
                <tr>
                    <td width="45"></td>
                    <td valign="top">
                        <p style="font-family: Arial; font-size: 24px; line-height: 137.99%; color: #222C67; font-weight: 600;">@lang('mails.hello') {{ $user->name }}!</p>
                        <p style="font-family: Arial; font-size: 20px; line-height: 28px; color: #616E7C;">
                            @lang('mails.new_user_registered')
                            <a href="{{ config('app.url') }}" style="color: #222C67 !important; display: inline-block; margin-left: 2px; font-family: Arial; font-size: 20px; line-height: 28px;">{{ config('app.url') }}</a>!
                        </p>
                        <div style="background: #ffffff; border: 1px solid #222C67; box-sizing: border-box; border-radius: 8px; margin-bottom: 20px;" class="table">
                            <div style="background: #222C67; border-radius: 8px 8px 0px 0px; text-align: center; color: #ffffff; padding: 15px;" class="table-header">
                                <p style="margin: 0; color: #ffffff; font-size: 20px; line-height: 28px; text-align: center; font-weight: 400;">@lang('mails.user_data'):</p>
                            </div>
                            <div style="padding: 15px 70px;" class="table-body">
                                @include('frontend.mails.authorization.include.client_info')
                            </div>
                        </div>
                    </td>
                    <td width="45"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection