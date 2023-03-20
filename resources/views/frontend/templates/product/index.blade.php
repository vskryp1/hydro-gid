@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('h1', $product->name)
@section('canonical', $seo_meta['seo_canonical'])
@section('seo_content')
    {!! $seo_meta['seo_content'] !!}
@endsection
@include('frontend.elements.ogMeta')
@section('productSeo')
    @include('frontend.elements.productSeo')
@endsection

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/product.min.css')) !!}
@endsection
@section('pageEvent')
    <script>
        gtag('event', 'view_item', {
            'send_to': 'AW-627401891',
            'value': '{{ $product->format_price }}',
            'items': [{
                'id': '{{ $product->sku }}',
                'google_business_vertical': 'retail'
            }]
        });
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
        fbq('track', 'ViewContent', {
            content_ids: ['{{ $product->sku }}'],
            content_type: 'product',
            value: '{{ $product->format_price }}',
            currency: 'UAH'
        });
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=3289447984432890&ev=PageView&noscript=1"/>
    </noscript>
@endsection
@section('scripts')
    @parent

    {!! JsValidator::formRequest('App\Http\Requests\Frontend\Review\SaveFormRequest', '#product-review-form') !!}
    <script>
        window.global_var.messages = {
            already_added: `<p>{{ __('frontend.already_added') }}</p>`,
        };
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'UAH',
                'detail': {
                    'products': [{
                        'name': '{{ $product->name }}',
                        'id': '{{ $product->sku }}',
                        'price': '{{ $product->format_price }}',
                        'brand': '{{ ShopHelper::setting("site_name") }}',
                        'category': '{{ $product->getMainCategoryAttribute()->name }}',
                    }]
                },
                'event': 'gtmUaEvent',
                'gtmUaEventCategory': 'Enhanced Ecommerce',
                'gtmUaEventAction': 'Product Details',
                'gtmUaEventNonInteraction': 'True'
            }
        });
    </script>
    {!! Html::script(mix('/assets/frontend/js/product.js')) !!}

@endsection
@include('frontend.elements.buyOneClickSeo')

@section('content')
    <main class="main product-page">
        <div class="products" style="background-image: url('{{ url('/assets/frontend/images/serv-bg-comp.png') }}');">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
        </div>
        @include('frontend.templates.product.includes.item')
        @include('frontend.templates.product.includes.item_description')
        @include('frontend.templates.product.includes.related')
        @include('frontend.templates.product.includes.similar')
    </main>
@endsection
