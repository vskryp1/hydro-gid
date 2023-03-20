@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/personal.min.css')) !!}
@endsection

@section('scripts')
    @parent

    <script>
        window.nothing_found = '{{ __('frontend.nothing_found') }}';
        window.nothing_found = '{{ __('frontend.nothing_found') }}';
        window.translates = {};
        window.translates.search = "@lang('frontend.search')";
        window.translates.search_message = "@lang('frontend.search_message')";
        window.translates.not_found_message = "@lang('frontend.not_found_message')";
        window.translates.searching_message = "@lang('frontend.searching_message')";
    </script>
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\Profile\UpdateUserFormRequest', '#user-data-form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\Address\SaveFormRequest', '#store-address-form') !!}
    @isset($data['addresses'])
        @foreach($data['addresses'] as $i => $address)
            @php(++$i)
            {!! JsValidator::formRequest('App\Http\Requests\Frontend\Address\SaveFormRequest', '#update-address-form-' . $i) !!}
        @endforeach
    @endisset
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\Profile\ChangePasswordRequest', '#change-password'); !!}
    {!! Html::script(mix('/assets/frontend/js/personal.js')) !!}
@endsection
@include('frontend.elements.buyOneClickSeo')
@section('content')
    <main>
        <div class="personal">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="container">
                <div class="personal__title">
                    <button class="personal_menu js-menuOpen">
                        <i class="icon icon-menu"></i>
                    </button>
                    {{ $page->name }}
                </div>
                <div class="personal__tabs header__tabs">
                    <div id="details" class="personal__tab active">
                        <a href="#personal-tab">@lang('frontend/profile/index.my_data')</a>
                    </div>
                    <div id="delivery" class="personal__tab">
                        <a href="#address-tab">@lang('frontend/profile/index.my_addresses')</a>
                    </div>
                    <div id="orders" class="personal__tab">
                        <a href="#orders-tab">@lang('frontend/profile/index.my_orders')</a>
                    </div>
                    <div id="wish-list" class="personal__tab">
                        <a href="#wishlist-tab">@lang('frontend/profile/index.wishlist')</a>
                    </div>
                    <div id="waiting-list" class="personal__tab">
                        <a href="#waitinglist-tab">@lang('frontend/profile/index.waitinglist')</a>
                    </div>
                    <div id="reviews" class="personal__tab">
                        <a href="#reviews-tab">@lang('frontend/profile/index.my_reviews')</a>
                    </div>
                </div>
                <div class="personal__content content__tabs">
                    @include('frontend.templates.account.data.index')

                    @include('frontend.templates.account.address.index')

                    @include('frontend.templates.account.orders.index')

                    @include('frontend.templates.account.wishlist.index')

                    @include('frontend.templates.account.waitinglist.index')

                    @include('frontend.templates.account.reviews.index')
                </div>
            </div>
        </div>
    </main>
@endsection
