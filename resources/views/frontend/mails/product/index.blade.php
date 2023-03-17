<table style="background: #fefefe; border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
    <tbody>
    <tr style="width: 90%; border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; display: block; margin: 0 auto; margin-bottom: 50px; overflow: hidden;"
        align="center">
        <td style="display: block; width: 100%;">
            <table style="margin: 0 auto; background: #fefefe; border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
                <tbody>
                    <tr height="25" style="line-height:0;font-size:0; width: 100%; border-top: 1px solid #CFD2E6;">
                        <td colspan="6"></td>
                    </tr>
                    <tr style="font-size:14px;line-height:1.5; width: 100%;">
                        <td colspan="2">
                            <table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top; width: 120px;"><a href="{{ $product->alias }}" style="width: 100%;">
                                            <img style="margin: 0 auto; max-height: 80px; width: auto; display: block;" src="{{ $product->cover->getUrl('prod_md') }}" alt='{{ $product->name }}'></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="5">
                            <table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
                                <tbody>
                                <tr>
                                    <td style="padding:0 10px;text-align:left;vertical-align: middle; font-size: 18px; line-height:25px; color: #515151;"><a href="{{ $product->alias }}"                                                                                                                                                            style="text-decoration: none;">
                                            <h4 style="font-family: Arial; font-size: 14px; line-height: 20px; letter-spacing: 0.1px; color: #21283D; font-weight: 600; text-decoration: none;">
                                                {{ $product->name }}
                                            </h4>
                                        </a></td>
                                    <td width="45"></td>
                                </tr>
                                </tbody>
                            </table>
                            <table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 100%;" align="center">
                                <tbody>
                                <tr>
                                    <td style="padding:0 10px;text-align:left;vertical-align: middle; font-family: Arial; font-size: 20px; line-height: 24px; letter-spacing: 0.15px; color: #222C67; font-weight: 700;">
                                        <span style="margin-right: 5px; display: inline-block;">{{ $product->format_price }}</span>
                                        <span style="font-family: Arial; font-size: 14px; line-height: 20px; letter-spacing: 0.25px; color: #222C67; font-weight: 300;">@lang('frontend/product/index.uah')</span>
                                    </td>
                                    <td width="45"></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr height="25" style="line-height:0;font-size:0; width: 100%; border-bottom: 1px solid #CFD2E6;">
                        <td colspan="6"></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>