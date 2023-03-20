<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: DejaVu Sans, serif;
            margin: 0;
        }

        .pdf-logo {
            display: inline-block;
            vertical-align: middle;
            width: 20%;
            float: left;
            padding-right: 15px;
        }

        .pdf-logo img {
            width: 100%;
        }

        .pdf-container {
            max-width: 850px;
            margin: auto;
        }

        .pdf-header {
            padding-top: 40px;
            display: block;
            border-bottom: 1px solid #E6E9EB;
            padding-bottom: 33px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .pdf-header:after {
            content: '';
            display: block;
            clear:both
        }

        .pdf-data {
            font-size: 14px;
            line-height: 1.5;
            color: #21283D;
            width: 40%;
            float: left;
        }

        .pdf-data a {
            color: #21283D;
            display: block;
            text-decoration: none;
        }

        .pdf-contact__ico {
            width: 15px;
            display: inline-block;
            vertical-align: middle;
            padding-right: 10px;
        }

        .pdf-contact__ico img {
            max-width: 100%;
        }

        .pdf-date {
            font-weight: bold;
            font-size: 14px;
            line-height: 21px;
            letter-spacing: 0.592076px;
            color: #21283D;
            padding: 10px;
            background: #F3F4F6;
            display: inline-block;
        }

        .pdf-body {
            padding: 0 20px;
        }

        .pdf-title {
            color: #21283D;
            font-weight: bold;
            font-size: 30px;
            line-height: 35px;
            padding-bottom: 33px;
        }

        .pdf-title:after {
            content: '';
            display: block;
            clear: both;
        }

        .pdf-title_t {
            width: 70%;
            float: left;
            padding-right: 15px;
        }

        .pdf-title_img {
            width: 30%;
            float: left;
        }
        .pdf-title_img img {
            max-width: 100%;
            height: auto;
        }

        .pdf-text {
            font-size: 14px;
            line-height: 21px;
        }

        .pdf-info__item {
            padding: 33px 0;
            border-bottom: 1px solid #AAADBB;
        }

        .pdf-info__item:last-child {
            border-bottom: none;
        }

        .pdf-info__item table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .pdf-info__item tr:nth-child(odd) {
            background: #F3F4F6;
        }

        .pdf-info__item td {
            padding: 15px;
            min-width: 200px;
        }


        .pdf-title__img img {
            max-width: 200px;
            padding-left: 50px;
        }

        .pdf-footer {
            border-top: 1px solid #AAADBB;
            padding: 33px 0;
            margin: 33px 20px 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <main class="pdf">
        <div style="width: 100%">
            <img style="width: 100%" src="{{ asset('assets/frontend/images/pdf/bg.jpg') }}" alt="">
        </div>
        <div class="pdf-container">
            <div>
                <div class="pdf-header">
                    <div class="pdf-logo">
                        {!! Html::image(ShopHelper::getLogoUrl('header'), 'header-logo') !!}
                    </div>

                    <div class="pdf-data">
                        <div>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', ShopHelper::setting('phone_number_first')) }}">
                                <span class="pdf-contact__ico">
                                    {!! Html::image(asset('assets/frontend/images/pdf/phone.png'), '') !!}
                                </span>
                                {{ ShopHelper::setting('phone_number_first') }}
                            </a>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', ShopHelper::setting('phone_number_second')) }}">
                                <span class="pdf-contact__ico">
                                    {!! Html::image(asset('assets/frontend/images/pdf/phone.png'), '') !!}
                                </span>
                                {{ ShopHelper::setting('phone_number_second') }}
                            </a>
                            <a href="skr-hydraulic.com.ua">
                                <span class="pdf-contact__ico">
                                     {!! Html::image(asset('assets/frontend/images/pdf/site.png'), '') !!}
                                </span>
                                {{ ShopHelper::setting('site_name', '', App::getLocale()) }}
                            </a>
                            <a href="mailto:{{ ShopHelper::setting('site-info-email') }}">
                                <span class="pdf-contact__ico">
                                     {!! Html::image(asset('assets/frontend/images/pdf/mail.png'), '') !!}
                                </span>
                                {{ ShopHelper::setting('site-info-email') }}
                            </a>
                        </div>
                    </div>
                    <div class="pdf-data">
                        {{ ShopHelper::setting("tov-name") }}
                        <br/>@lang('frontend/product/index.edrpou') {{ ShopHelper::setting("edrpou") }}
                        <br/>@lang('frontend/product/index.inn') {{ ShopHelper::setting("inn") }}<br/>
                        @lang('frontend/product/index.rro')<br/> {{ ShopHelper::setting("rro") }}
                        <br/> {{ ShopHelper::setting("rro-bank") }}, @lang('frontend/product/index.mfo')
                        {{ ShopHelper::setting("mfo") }}
                    </div>
                </div>

                <div class="pdf-body">
                    <div class="pdf-descr">
                        <div class="pdf-date">
                    <span class="pdf-contact__ico">
                        {!! Html::image(asset('assets/frontend/images/pdf/calendar.png'), '') !!}
                    </span>
                            {{ Carbon::now()->translatedFormat('j F Y') }}
                        </div>
                        <div class="pdf-info__item">
                            <div class="pdf-title">@lang('frontend/product/index.pdf_title')</div>
                            <div class="pdf-text">
                                @lang('frontend/product/index.pdf_title_text')
                            </div>
                        </div>
                        <div class="pdf-info__item">
                            <div class="pdf-title">
                                <div class="pdf-title_t">{{ $product->name }}</div>
                                <div class="pdf-title_img">
                                     {!! Html::image($product->cover->getUrl('prod_xl'), '#') !!}
                                </div>
                            </div>
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <strong>
                                            {{ $product->format_price }}
                                        </strong> @lang('frontend/product/index.uah')
                                    </td>
                                    @switch((string) $product->availability)
                                        @case(ProductAvailability::NOT_AVAILABLE)
                                        <td>
                                            <strong>@lang('frontend/product/index.out_of_stock')</strong>
                                        </td>
                                        @break
                                        @case(ProductAvailability::UNDER_ORDER)
                                        <td>
                                            <strong>@lang('frontend/product/index.under_order')</strong>
                                        </td>
                                        @break
                                        @case(ProductAvailability::EXPECTED_DELIVERY)
                                        <td>
                                            <strong>@lang('frontend/product/index.under_order')</strong>
                                        </td>
                                        @break
                                        @default
                                        <td>
                                            <strong>@lang('frontend/product/index.available')</strong>
                                        </td>
                                    @endswitch
                                    <td>
                                        @lang('frontend/product/index.article') <strong>{{ $product->sku }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('frontend/product/index.price_with_pdv')</td>
                                    @switch((string) $product->availability)
                                        @case(ProductAvailability::NOT_AVAILABLE)
                                        <td></td>
                                        @break
                                        @case(ProductAvailability::UNDER_ORDER)
                                        <td>@lang('frontend/product/index.delivery_date')
                                            - {{ $product->under_order_weeks }} @lang(trans_choice('frontend/product/index.weeks', $product->under_order_weeks))</td>
                                        @break
                                        @case(ProductAvailability::EXPECTED_DELIVERY)
                                        <td>
                                            @lang('frontend/product/index.delivery_date')
                                            - @lang(trans_choice('frontend/product/index.expected_days', Carbon::now()->diffInDays($product->expected_at)+1))
                                        </td>
                                        @break
                                        @default
                                        <td></td>
                                    @endswitch
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="pdf-info__item">
                            <div class="pdf-title">
                                @lang('frontend/product/index.main_params')
                            </div>
                            <table>
                                <tbody>
                                @foreach($baseFilters as $filter)
                                    <tr>
                                        <td>
                                            <strong>
                                                {{ $filter->name }}
                                            </strong>
                                        </td>
                                        <td>
                                            {{ $filter->filter_values->pluck('name')->implode(', ') }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pdf-info__item">
                            <div class="pdf-title">
                                @lang('frontend/product/index.condition_delivery')
                            </div>
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <strong>
                                            @lang('frontend/product/index.condition_payment')
                                        </strong>
                                    </td>
                                    <td>
                                        @lang('frontend/product/index.pdf_price_changing')
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>@lang('frontend/product/index.payments'):</strong></td>
                                    <td>@lang('frontend/product/index.pdf_percent_payment')</td>
                                </tr>
                                {{--<tr>--}}
                                    {{--<td><strong>@lang('frontend/product/index.delivery_value')</strong></td>--}}
                                    {{--<td>@lang('frontend/product/index.tools')--}}
                                        {{--@lang('frontend/product/index.documents')</td>--}}
                                {{--</tr>--}}
                                <tr>
                                    <td><strong>@lang('frontend/product/index.warranty'):</strong></td>
                                    <td>@lang('frontend/product/index.warranty_term')</td>
                                </tr>
                                {{--<tr>--}}
                                    {{--<td><strong>Термін дії пропозиції:</strong></td>--}}
                                    {{--<td>Пропозиція діє до 12.07.2020 року</td>--}}
                                {{--</tr>--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="pdf-footer">
                    <div class="pdf-copy">© {{ ShopHelper::setting('site_name', '', App::getLocale()) }}</div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>