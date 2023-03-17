@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')
@section('transactionTrack')
    @include('frontend.elements.transactionTrack')
@endsection

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/success-order.min.css')) !!}
@endsection

@if(session()->get('order_products')->count())
    @section('pageEvent')
        <script>
            gtag('event', 'purchase', {
                'send_to': 'AW-627401891',
                'value': '{{ $order->total_price }}',
                'items': [
                        @foreach(session()->get('order_products') as $item)
                    {
                        'id': '{{ $item["sku"] }}',
                        'google_business_vertical': 'retail'
                    }@unless($loop->last),@endif
                    @endforeach
                ]
            });
            if(window.sessionStorage.getItem('is_send_ecomerce') === 'false')
            {
                window.dataLayer = window.dataLayer || [];
                dataLayer.push({
                    'ecommerce': {
                        'currencyCode': 'UAH',
                        'purchase': {
                            'actionField': {
                                'id': '{{ $order->unique_id }}',
                                'revenue' : '{{ session()->get('total_price') }}'
                            },
                            'products': [
                                    @foreach(session()->get('order_products') as $item)
                                {
                                    'name': '{{ $item["name"] }}',
                                    'id': '{{ $item["sku"] }}',
                                    'price': '{{ $item["price"] }}',
                                    'brand': '{{ ShopHelper::setting("site_name") }}',
                                    'category': '{{ $item["category"] }}'
                                }@unless($loop->last),@endif
                                @endforeach
                            ]
                        }
                    },
                    'event': 'gtmUaEvent',
                    'gtmUaEventCategory': 'Enhanced Ecommerce',
                    'gtmUaEventAction': 'Purchase',
                    'gtmUaEventNonInteraction': 'True'
                });
            }
        </script>
    @endsection
    @section('facebookEvent')
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '3289447984432890');
            fbq('track', 'PageView');
            fbq('track', 'Purchase', {
                'content_ids': [
                    @foreach(session()->get('order_products') as $item)
                        '{{ $item["sku"] }}' @unless($loop->last),@endif
                    @endforeach
                ],
                'content_type': 'product',
                'value': '{{ session()->get('total_product_price') }}',
                'currency': 'UAH'
            });
        </script>
        <noscript>
            <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=3289447984432890&ev=PageView&noscript=1"/>
        </noscript>
    @endsection
@endif

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="success-order">
            <div class="success-order__inner">
                <img src="{{ asset('assets/frontend/images/basket-images.png') }}"/>
                <div class="success-order__title">
                    @lang('frontend/checkout/index.you_order_completed')
                </div>
                <div class="success-order__number">
                    @lang('frontend/checkout/index.you_order_number'): <span>#{{ $order->unique_id }}</span>
                </div>
                <div class="success-order__text">
                    @lang('frontend/checkout/index.you_will_receive_mail')
                </div>
                <a class="success-order__link" href="{{ route('frontend.page', PageAlias::PAGE_CATALOG) }}">
                    @lang('frontend/checkout/index.continue_shopping')
                </a>
            </div>
        </div>
    </main>
@endsection