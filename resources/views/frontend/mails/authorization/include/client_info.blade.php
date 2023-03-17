<table cellpadding="0" cellspacing="0" style="border-collapse:collapse;vertical-align:top;width: 100%;">
    <tbody>
    <tr style="border-bottom: 1px solid #F3F4F6;">
        <td width="25" style="padding-top: 5px; padding-bottom: 5px;"></td>
        <td colspan="3" style="line-height:0; font-size:0; border-right: 1px solid #F3F4F6; padding-top: 5px; padding-bottom: 5px;">
            <p style="font-family: Arial; font-size: 16px; line-height: 137.99%; margin: 0; color: #616E7C; padding-top: 5px; padding-bottom: 5px;">@lang('mails.login'):</p>
        </td>
        <td colspan="3" style="line-height:0; font-size:0; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;">
            @isset($client)
            <p style="font-family: Arial; font-size: 16px; line-height: 137.99%; margin: 0; color: #1F2933; padding-top: 5px; padding-bottom: 5px;">{{ $client->email }}</p>
            @endisset
        </td>
        <td width="50"></td>
    </tr>
    </tbody>
</table>