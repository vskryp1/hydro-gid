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
                        <h3>@lang('mails.hello') !</h3>
                        <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #5C6A7F;">
                            @lang('mails.received_new_request'):
                            <br>
                            {{ $serviceOrder->type->description }}
                            <br>
                            @isset($serviceOrder->call_me)
                                @if($serviceOrder->call_me)
                                    @lang('mails.ask_question_with_callback')
                                @endif
                            @endisset
                        </p>
                        @if($serviceOrder->page)
                            <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #5C6A7F;">
                                {{ $serviceOrder->page->name }}
                                <br>
                            </p>
                        @endif
                        @isset($serviceOrder->username)
                            <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #5C6A7F; padding: 5px 0;"><span style="color: #5C6A7F; margin-bottom: 10px; display: inline-block;">@lang('mails.name')
                                    :</span><br><span
                                        style="line-height:17px;color:#222C67;display: inline-block;vertical-align: middle;padding-left: 3px;">{{ $serviceOrder->username }}</span>
                            </p>
                        @endisset
                        @isset($serviceOrder->phone)
                            <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #5C6A7F; padding: 5px 0;"><span
                                        style="color: #5C6A7F; margin-bottom: 10px; display: inline-block;">№ @lang('mails.phone_number'):</span><br><a
                                        style="color: #222C67; text-decoration: none; display: inline-block; background-color: #F7F7F7; padding: 10px 20px; font-weight: 700;"
                                        href="tel:{{ $serviceOrder->phone }}">{{ $serviceOrder->phone }}</a>
                            </p>
                        @endisset
                        @isset($serviceOrder->email)
                            <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #5C6A7F; padding: 5px 0;"><span style="color: #5C6A7F; margin-bottom: 10px; display: inline-block;">@lang('frontend.email')
                                    :</span><br><a
                                        style="color: #222C67; text-decoration: none; display: inline-block; background-color: #F7F7F7; padding: 10px 20px; font-weight: 700;"
                                        href="mailto:{{ $serviceOrder->email }}">{{ $serviceOrder->email }}</a></p>
                        @endisset
                        @isset($serviceOrder->comment)
                            <p style="font-family: Arial; font-size: 14px; line-height: 19px; color: #5C6A7F; padding: 5px 0;"><span style="color: #5C6A7F; margin-bottom: 10px; display: inline-block;">@lang('mails.comment')
                                    :</span><br><span
                                        style="line-height:17px;color:#222C67;display: inline-block;vertical-align: middle;padding-left: 3px;">{{ $serviceOrder->comment }}</span></p>
                        @endisset
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