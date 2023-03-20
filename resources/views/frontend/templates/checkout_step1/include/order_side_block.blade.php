<div class="checkout__aside">
    <div class="checkout__aside-title">
        @lang('frontend/checkout/index.you_order')
    </div>
    @foreach($cartItems as $item)
        <div class="checkout__aside-item">
            <picture>
                <source type="image/webp" srcset="{{ $item->model->cover->getUrl('prod_cart', true) }}">
                <img class="checkout__aside-img" src="{{ $item->model->cover->getUrl('prod_cart') }}"
                     alt="{{ $item->model->cover->getImageAlt() }}"
                     title="{{ $item->model->cover->getImageTitle() }}">
            </picture>
            <div class="checkout__aside-info"
                 data-name="{{ $item->model->name }}"
                 data-sku="{{ $item->model->sku }}"
                 data-category="{{ $item->model->getMainCategoryAttribute()->name }}"
                 data-price="{{ $item->model->format_price }}"
                 data-brand="{{ ShopHelper::setting("site_name") }}"
                 data-qty="{{ $item->qty }}">
                <div class="checkout__aside-text">
                    {{ $item->model->name }}
                    {{ $item->getWarrantyText() }}
                </div>
                <div class="checkout__aside-number">
                    <div class="checkout__aside-prise">
                        {{ $item->getFormattedSumPriceByPosition() }}
                        <span>@lang('frontend/product/index.uah')</span>
                    </div>
                    <div class="checkout__aside-sum">
                        {{ $item->qty }} @lang('frontend/checkout/index.qty')
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <a class="edit-order__link"
       href="{{ route('frontend.page', 'basket') }}">@lang('frontend/checkout/index.edit_order')</a>
    @if(!empty(Auth::guard('web')->user()->discount) && CartHelper::getDiscount())
        <div class="basket__summarize-item">
            <div class="basket__summarize-text">
                {{ Cart::count() }} @lang(trans_choice('frontend/checkout/index.products_on_sum', Cart::count()))
            </div>
            <div class="basket__summarize-prise">
                {{ CartHelper::totalProductsPriceFormatted() }}
                <span>{{ $currency->sign }}</span>
            </div>
        </div>
    @endif
    <div class="basket__summarize-item @if($current_delivery->price >= 0) d-none  @endif">
        <div class="basket__summarize-text">
            @lang('frontend/checkout/index.delivery_cost')
        </div>
        <div class="basket__summarize-prise">
            <strong class="js-checkout-delivery-price">{{ $current_delivery->format_price }}</strong>
            <span>{{ $currency->sign }}</span>
        </div>
    </div>
    @include('frontend.templates.checkout_step1.include.discount_block')
    <div class="basket__total">
        <div class="basket__total-text">
            @lang('frontend/checkout/index.total')
        </div>
        <div class=" basket__total-prise">
            <strong class="js-checkout-total-price">{{ CartHelper::getTotalFormatted() }}</strong>
            <span>{{ $currency->sign }}</span>
        </div>
    </div>
    <div class="basket__total payparts-first-payment" style="display: none;">
        <div class="basket__total-text">
            @lang('frontend.paypart_first_payment')
        </div>
        <div class=" basket__total-prise">
            <strong id="js-payparts-first-payment"></strong>
            <span>{{ $currency->sign }}</span>
        </div>
    </div>
</div>