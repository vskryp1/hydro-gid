@extends('frontend.mails.layout')

@section('content')
    <tr style="line-height:14px; font-size: 14px;">
        <td bgcolor="#ffffff" style=" padding: 20px 25px 0; font-size: 15px; line-height: 22px; ">
            {!! $body !!}
        </td>
    </tr>
    <tr style="line-height:14px; font-size: 14px;">
        <td>
            <span style="display: block;font-size: 16px;line-height: 18px;margin-bottom: 14px;color: #3D3D3D;">Если вы хотите отписаться, <a class="link"  style="background-color: transparent;text-decoration: none;color: #2684FE;" href="{{ route('frontend.unsubscribe',[$subscriber->id]) }}">перейдите по ссылке</a></span>
        </td>
    </tr>
@endsection
