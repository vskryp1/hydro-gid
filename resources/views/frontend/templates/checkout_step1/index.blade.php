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

    {!! JsValidator::formRequest('App\Http\Requests\Frontend\Checkout\StoreStep1Request', '#page-register-form') !!}
    {!! Html::script(mix('/assets/frontend/js/category.js')) !!}
@endsection

@section('content')
    <main>
        <div class="checkout" data-step="1">
            @include('frontend.templates.checkout_step1.include.checkout_head', ['step' => ''])
            <div class="container">
                <div class="checkout__inner">
                    <div class="checkout__content">
                        <div class="checkout__btn">
                            <a class="active" href="#">@lang('frontend/checkout/index.i_new_client')</a>
                            <a href="#" data-fancybox=""
                               data-src="#modal">@lang('frontend/checkout/index.i_auth_client')</a>
                        </div>
                        <div class="checkout__content-title">
                            <span>1</span>@lang('frontend/checkout/index.contacts')
                        </div>
                        <div class="checkout__checkbox">
                            @include('frontend.templates.checkout_step1.include.register_form')
                        </div>
                    </div>
                    <div class="checkout__content-title not-active">
                        <span>2</span> @lang('frontend/checkout/index.choose_delivery_payment')
                    </div>
                </div>
                @include('frontend.templates.checkout_step1.include.order_side_block')
            </div>
        </div>
    </main>
@endsection