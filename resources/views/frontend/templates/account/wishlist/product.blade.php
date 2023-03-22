<div class="item-prod col-lg-3 js_product">
    <div class="prod-cart">
        @include('frontend.elements.product.status', ['product' => $product])
        <div class="prod-cart__addto">
            @include('frontend.elements.product.lists_buttons.compare_list_btn')
            @include('frontend.elements.product.lists_buttons.wishlist_btn', ['type' => 'personal'])
        </div>
        <div class="prod-cart__top">
            <a href="{{ $product->alias }}">
                <div class="prod-cart__img">
                    <picture>
                        <source type="image/webp" srcset="{{ $product->cover->getUrl('prod_md', true) }}">
                        <img src="{{ $product->cover->getUrl('prod_md') }}"
                             alt="{{ $product->cover->getImageAlt() }}"
                             title="{{ $product->cover->getImageTitle() }}">
                    </picture>
                </div>
                <div class="prod-cart__descr">
                    {{ $product->name }}
                </div>
            </a>
        </div>
        <ul class="prod-cart__list">
            @foreach($product->filter_values->groupByFiltersPosition() as $filterValue)
                <li>
                    {{ $filterValue->first()->filter->name }}: {{ $filterValue->implode('name', ', ') }}
                </li>
            @endforeach
        </ul>
        <div class="star-box">
            <div class="star js_review star-fill hidden-mob" data-mark="{{ $product->rating }}"
                 data-star-on="{{ url('/assets/frontend/images/on.svg') }}"
                 data-star-off="{{ url('/assets/frontend/images/off.svg') }}"></div>
        </div>

        @include('frontend.elements.product.price', ['product' => $product])

        @switch((string) $product->availability)
            @case(ProductAvailability::NOT_AVAILABLE)
            <div class="not-available-h">
                    <span class="not-available-txt">
                        @lang('frontend/product/index.out_of_stock')
                    </span>
                <a data-put="{{ route('ajax.user.put.in.waitinglist', [
                                                                'user_id' => auth('web')->id(),
                                                                'product' => $product, ]) }}"
                   data-method="POST"
                   data-inlist-message="@lang('frontend/profile/index.waitinglist_messages.exists')"
                   class="report js_put_in_waitinglist
                    @if(auth('web')->user()->hasProductInWaiting($product)) active @endif">
                    @lang('frontend/product/index.notify_when_appears')
                </a>
            </div>
            @break
            @case(ProductAvailability::UNDER_ORDER)
            <div class="prod-cart__order">
                    <span class="ttl">
                        @lang('frontend/product/index.under_order')
                    </span>
                <span class="discr">
                        @lang('frontend/product/index.delivery_date') - {{ $product->under_order_weeks }} @lang(trans_choice('frontend/product/index.weeks', $product->under_order_weeks))
                    </span>
            </div>
            <a data-href="{{ route('ajax.cart.add', $product) }}" data-method="POST"
               class="js-add-to-cart prod-cart__buy"
               data-fancybox=""
               data-src="#modal-basket"
               data-category="{{ $product->getMainCategoryAttribute()->name }}"
               data-name="{{ $product->name }}"
               data-sku="{{ $product->sku }}"
               data-price="{{ $product->format_price }}"
               data-brand="{{ ShopHelper::setting("site_name") }}">
                @lang('frontend/product/index.to_order')
            </a>
            @break
            @case(ProductAvailability::EXPECTED_DELIVERY)
            <div class="prod-cart__awaiting">
                    <span class="ttl">
                        @lang('frontend/product/index.expected_delivery')
                    </span>
                <span class="discr">
                        @lang('frontend/product/index.delivery_date') - @lang(trans_choice('frontend/product/index.expected_days', Carbon::now()->diffInDays($product->expected_at)+1))
                    </span>
            </div>
            <a data-href="{{ route('ajax.cart.add', $product) }}" data-method="POST"
               class="js-add-to-cart prod-cart__buy"
               data-fancybox=""
               data-src="#modal-basket"
               data-category="{{ $product->getMainCategoryAttribute()->name }}"
               data-name="{{ $product->name }}"
               data-sku="{{ $product->sku }}"
               data-price="{{ $product->format_price }}"
               data-brand="{{ ShopHelper::setting("site_name") }}">

                @lang('frontend/product/index.add_to_cart')
            </a>

            @break
            @default
            <a data-href="{{ route('ajax.cart.add', $product) }}" data-method="POST"
               class="js-add-to-cart prod-cart__buy"
               data-fancybox=""
               data-src="#modal-basket"
               data-category="{{ $product->getMainCategoryAttribute()->name }}"
               data-name="{{ $product->name }}"
               data-sku="{{ $product->sku }}"
               data-price="{{ $product->format_price }}"
               data-brand="{{ ShopHelper::setting("site_name") }}">
                @lang('frontend/product/index.add_to_cart')
            </a>
        @endswitch
    </div>
</div>