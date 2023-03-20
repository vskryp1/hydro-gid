@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent
    {!! Html::style(mix('/assets/frontend/css/checkout.min.css')) !!}
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="https://ppcalc.privatbank.ua/pp_calculator/resources/js/calculator.js"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\Checkout\StoreStep2Request', '#delivery_payment_form') !!}
    {!! Html::script(mix('/assets/frontend/js/category.js')) !!}
    <script>
        window.sessionStorage.setItem('is_send_ecomerce', false);
        window.totalProductsPrice = {{ CartHelper::getPaymentTotalFormatted() }};
    </script>
@endsection

@section('content')
    <main>
        <div class="checkout checkout-step-2" data-step="2">
            @include('frontend.templates.checkout_step1.include.checkout_head', ['step' => 'checkout__step-item-2'])
            <div class="container">
                <div class="checkout__inner">
                    <div class="checkout__content">
                        <div class="checkout__content-title done">
                            <span class="icon icon-check"></span>
                            @lang('frontend/checkout/index.contacts')
                            @Auth()
                                <a href="{{ route('frontend.page', PageAlias::PAGE_ACCOUNT) }}">
                                    @lang('frontend/checkout/index.edit_order')
                                    <span class="icon icon-edit"></span>
                                </a>
                            @else
                                <a href="{{ route('frontend.page', 'checkout-step1') }}">
                                    @lang('frontend/checkout/index.edit_order')
                                    <span class="icon icon-edit"></span>
                                </a>
                            @endauth
                        </div>
                        <div class="checkout__content-title">
                            <span>2</span> @lang('frontend/checkout/index.choose_delivery_payment')
                        </div>
                        <div class="checkout__radio-form">
                            @include('frontend.templates.checkout_step2.include.delivery_payment')
                        </div>
                        <a disabled="disabled" class="js-checkout__step-next checkout__step-next" href="" disabled>
                            @lang('frontend/checkout/index.confirm_order')
                        </a>
                    </div>
                    @include('frontend.templates.checkout_step1.include.order_side_block')
                </div>
            </div>
        </div>
    </main>
@endsection
