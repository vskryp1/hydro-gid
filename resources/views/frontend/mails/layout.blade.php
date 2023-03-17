<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ config('app.name', __('Гидро Гид')) }}
        @yield('title')
    </title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">
</head>
<body bgcolor="#ededed" style="background:#ededed;" marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" cz-shortcut-listen="true">
<div style="background-color:#ededed; height: 100%;">
    <table style="font-family: 'Arial', sans-serif; width: 600px; overflow:scroll; border-radius: 10px;" width="600" align="center" cellpadding="0" cellspacing="0">
        <tbody>
        <tr height="32" style="line-height:0; font-size:0;">
            <td></td>
        </tr>
        <tr>
            <td style="line-height:0; font-size:0; background-color:#F3F4F6; border-radius: 10px; overflow: hidden; box-sizing: border-box;">
                <table width="600" align="center" cellpadding="0" cellspacing="0" style="vertical-align:top; border-radius: 10px;">
                    <tbody style="">
                    <tr>
                        <td colspan="3" style="">
                            <table width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse;vertical-align:top;border-top: 10px solid #28347C;">
                                <tbody>
                                <tr>
                                    <td>
                                        <table width="600" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse;vertical-align:top;">
                                            <tbody>
                                            <tr>
                                                <td width="45"></td>
                                                <td height="122" style="line-height:0; font-size:0; width: 240px;">
                                                    <p style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0;"><a style="display: inline-block; max-width: 240px;" href="{{ config('app.url') }}"><img src="{{ asset('assets/frontend/images/logo@2.png') }}" style="max-width: 100%"></a></p>
                                                </td>
                                                <td height="122" colspan="3" style="line-height:0;font-size:0;text-align: right;white-space: nowrap;">
                                                    <span style="margin-right:5px;display: inline-block;vertical-align: middle;"><img src="{{ asset('assets/frontend/images/mails/phone.png') }}" alt="" style="margin: 0 auto;"></span>
                                                    <div style="display: inline-block;vertical-align: middle;">
                                                        <p style="display: block;margin: 0 10px 6px;font-size: 14px;line-height: 22px;font-weight: bold;">
                                                            <a href="tel:+38{{ ShopHelper::setting('phone_number_first', '(067) 633 23 53') }}" style="color: #212c67;">
                                                                {{ ShopHelper::setting('phone_number_first', '(067) 633 23 53') }}
                                                            </a>
                                                        </p>
                                                        <p style="display: block;margin: 0 10px 6px;font-size: 14px;line-height: 22px;font-weight: bold;">
                                                            <a href="tel:+38{{ ShopHelper::setting('phone_number_second', '(050) 702 33 12') }}" style="color: #212c67;">
                                                                {{ ShopHelper::setting('phone_number_second', '(050) 702 33 12') }}
                                                            </a>
                                                        </p>
                                                    </div>
                                                </td>
                                                <td width="45"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="1" bgcolor="#acacac"></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @yield('content')
                    <tr>
                        <td bgcolor="#1F2933" height="">
                            <table width="600" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse;vertical-align:top;">
                                <tbody>
                                <tr height="20" style="line-height:0; font-size:0;">
                                    <td colspan="5"></td>
                                </tr>
                                <tr>
                                    <td width="45"></td>
                                    <td width="245">
                                        <span style="display: inline-block;vertical-align: middle;"><img src="{{ asset

                                        ('assets/frontend/images/mails/map.png') }}" alt="" style="margin: 0 auto;"></span>
                                        <span style="font-size: 14px;line-height:17px;color:#AAADBB;display: inline-block;vertical-align: middle;padding-left: 3px;opacity: 0.8;">{{ ShopHelper::setting('site_address') }}</span>
                                    </td>
                                    <td width="145" style="text-align: right;">
                                        <span style="display: inline-block;vertical-align: middle;"><img src="{{ asset('assets/frontend/images/mails/mail.png') }}" alt="" style="margin: 0 auto;"></span>
                                        <span style="font-size: 14px;line-height:17px;color:#AAADBB;display: inline-block;vertical-align: middle;padding-left: 3px;opacity: 0.8;"><a style="color: #AAADBB; display: inline-block; margin-left: 10px; text-decoration:none;" href="mailto:{{ ShopHelper::setting('site_email') }}">{{ ShopHelper::setting('site_email') }}</a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="45"></td>
                                    <td colspan="3">
                                        <p style="font-size:10px;letter-spacing: 0.02em;line-height:14px;color:#AAADBB; padding: 20px 0; border-top: 1px solid #616E7C; border-bottom: 1px solid #283950; margin-bottom: 0;">
                                            <span>@lang('mails.warning_text')</span>
                                            <span style="margin-left: 5px;">
                                                @lang('mails.add_our_address')
                                            </span>
                                            <a style="font-size:10px;letter-spacing: 0.02em;line-height:14px;color:#AAADBB; !important; display: inline-block; margin-left: 5px; margin-right: 5px;" href="mailto:{{ ShopHelper::setting('site_email') }}">{{ ShopHelper::setting('site_email') }}</a>
                                            <span>@lang('mails.to_your_contacts')</span>
                                        </p>
                                    </td>
                                    <td width="45"></td>
                                </tr>
                                <tr height="25" style="line-height:0; font-size:0;">
                                    <td colspan="5"></td>
                                </tr>
                                <tr>
                                    <td width="45"></td>
                                    <td width="245">
                                        <div style="width:100%;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:start;-webkit-justify-content:flex-start;-ms-flex-pack:start;justify-content:flex-start;" class="footer__social">
                                            <ul style="display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;list-style:none;margin:0;width:150px;padding:0;" class="social-list">
                                                <li style="-webkit-box-flex:0;-webkit-flex-grow:0;-ms-flex-positive:0;flex-grow:0;margin-right:30px;margin:0 auto;" class="social-item"><a href="{{ ShopHelper::setting('facebook_link') }}" target="_blank" rel="nofollow" style="width: auto;height: auto;color: #616E7C;-webkit-transition: all .3s ease;-o-transition: all .3s ease;transition: all .3s ease;"><img src="{{ asset('assets/frontend/images/mails/facebook.png') }}" alt="" style="margin: 0 auto;"></a></li>
                                                <li style="-webkit-box-flex:0;-webkit-flex-grow:0;-ms-flex-positive:0;flex-grow:0;margin-right:30px;margin:0 auto;" class="social-item"><a href="{{ ShopHelper::setting('instagram_link') }}" target="_blank" rel="nofollow" style="width: auto;height: auto;color: #616E7C;-webkit-transition: all .3s ease;-o-transition: all .3s ease;transition: all .3s ease;"><img src="{{ asset('assets/frontend/images/mails/instagram.png') }}" alt="" style="margin: 0 auto;"></a></li>
                                                <li style="-webkit-box-flex:0;-webkit-flex-grow:0;-ms-flex-positive:0;flex-grow:0;margin-right:30px;margin:0 auto;" class="social-item"><a href="{{ ShopHelper::setting('linkedin_link') }}" target="_blank" rel="nofollow" style="width: auto;height: auto;color: #616E7C;-webkit-transition: all .3s ease;-o-transition: all .3s ease;transition: all .3s ease;"><img src="{{ asset('assets/frontend/images/mails/linkedin.png') }}" alt="" style="margin: 0 auto;"></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td width="245" style="text-align: right;">
                                        <span style="font-size: 10px;line-height:14px;letter-spacing: 0.02em;color:#AAADBB;display: inline-block;vertical-align: middle;padding-left: 3px;">©{{ ShopHelper::setting('site_name') }} @lang('frontend.all_rights_reserved')</span>
                                    </td>
                                </tr>
                                <tr height="30" style="line-height:0; font-size:0;">
                                    <td colspan="5"></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>